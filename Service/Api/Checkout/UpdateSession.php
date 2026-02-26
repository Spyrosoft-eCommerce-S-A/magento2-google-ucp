<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api\Checkout;

use Exception;
use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\Data\ShippingInformationInterfaceFactory;
use Magento\Checkout\Api\ShippingInformationManagementInterface;
use Magento\Framework\Exception\InputException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;
use Magento\Quote\Model\Quote;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Api\Checkout\Handler\LineItems as LineItemsHandler;
use Spyrosoft\Ucp\Service\Builder\Checkout as CheckoutBuilder;
use Spyrosoft\Ucp\Service\Config;

class UpdateSession
{
    public function __construct(
        private readonly CheckoutBuilder $checkoutBuilder,
        private readonly MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        private readonly CartRepositoryInterface $cartRepository,
        private readonly ShippingInformationInterfaceFactory $shippingInformationFactory,
        private readonly ShippingInformationManagementInterface $shippingInformationManagement,
        private readonly LineItemsHandler $lineItemsHandler,
        private readonly Config $config
    ) {
    }

    /**
     * @param LineItemInterface[]|null $line_items
     */
    public function execute(
        string $maskedQuoteId,
        ?array $line_items = null,
        ?string $currency = null,
        ?PaymentInterface $payment = null,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null,
    ): CheckoutInterface {
        try {
            $quoteId = $this->maskedQuoteIdToQuoteId->execute($maskedQuoteId);
            /** @var Quote $quote */
            $quote = $this->cartRepository->getActive($quoteId);
        } catch (Exception) {
            throw new InputException(__('The checkout session with the provided ID does not exist.'));
        }

        $errorMessages = [];

        $billingAddress = $quote->getBillingAddress();
        $shippingAddress = $quote->getShippingAddress();

        if ($buyer !== null) {
            $quote->setCustomerFirstname($buyer->getFirstname());
            $quote->setCustomerLastname($buyer->getLastName());
            $quote->setCustomerEmail($buyer->getEmail());

            $billingAddress->setEmail($buyer->getEmail());
            $shippingAddress->setEmail($buyer->getEmail());

            $billingAddress->setFirstname($buyer->getFirstName());
            $billingAddress->setLastname($buyer->getLastName());
            $billingAddress->setTelephone($buyer->getPhoneNumber());
        }

        if ($fulfillment !== null) {
            $destination = ($fulfillment->getMethods()[0] ?? null)?->getDestinations()[0] ?? null;

            if ($destination !== null) {
                $shippingAddress->setSameAsBilling(false);
                $shippingAddress->setFirstname($destination->getFirstName() ?: $shippingAddress->getFirstname());
                $shippingAddress->setLastname($destination->getLastName() ?: $shippingAddress->getLastname());
                $shippingAddress->setCountryId(
                    $destination->getAddressCountry() ?:
                        $shippingAddress->getCountryId() ?:
                            $this->config->getDefaultCountry()
                );
                $shippingAddress->setRegionCode($destination->getAddressRegion() ?: $shippingAddress->getRegionCode());
                $shippingAddress->setCity($destination->getAddressLocality() ?: $shippingAddress->getCity());
                $shippingAddress->setPostcode($destination->getPostalCode() ?: $shippingAddress->getPostcode());
                $shippingAddress->setTelephone($destination->getPhoneNumber() ?: $shippingAddress->getTelephone());
                $shippingAddress->setStreetFull($destination->getStreetAddress() ?: $shippingAddress->getStreetFull());

                $billingAddress->setCountryId($shippingAddress->getCountryId());
                $billingAddress->setRegionCode($shippingAddress->getRegionCode());
                $billingAddress->setCity($shippingAddress->getCity());
                $billingAddress->setPostcode($shippingAddress->getPostcode());
                $billingAddress->setStreetFull($shippingAddress->getStreetFull());
            }
        }

        if (!$shippingAddress->getCountryId()) {
            $shippingAddress->setCountryId($this->config->getDefaultCountry());
            $billingAddress->setCountryId($this->config->getDefaultCountry());
        }

        if ($selectedFulfillmentOption !== null) {
            [$carrierCode, $methodCode] = explode('_', $selectedFulfillmentOption, 2);

            /** @var ShippingInformationInterface $shippingInformation */
            $shippingInformation = $this->shippingInformationFactory->create([
                'data' => [
                    /* If the address is not a shipping address (but billing) the system will find the proper shipping
                       address for the selected cart and set the information there (actual for single shipping address) */
                    ShippingInformationInterface::SHIPPING_ADDRESS => $shippingAddress,
                    ShippingInformationInterface::SHIPPING_CARRIER_CODE => $carrierCode,
                    ShippingInformationInterface::SHIPPING_METHOD_CODE => $methodCode,
                ],
            ]);

            $this->shippingInformationManagement->saveAddressInformation($quoteId, $shippingInformation);
        } else {
            // quote could be already saved in shippingInformationManagement
            $this->cartRepository->save($quote);
        }

        if (!empty($line_items)) {
            $errorMessages = $this->lineItemsHandler->handle($maskedQuoteId, $quote, $line_items);
        }

        $cart = $this->cartRepository->getActive($quoteId);

        return $this->checkoutBuilder->build(
            $maskedQuoteId,
            $cart,
            $errorMessages
        );
    }
}
