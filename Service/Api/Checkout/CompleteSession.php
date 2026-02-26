<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api\Checkout;

use Exception;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\PaymentMethodManagementInterface;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Psr\Log\LoggerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Builder\Checkout as CheckoutBuilder;
use Spyrosoft\Ucp\Service\Payment\HandlerList;

class CompleteSession
{
    public function __construct(
        private readonly CheckoutBuilder $checkoutBuilder,
        private readonly MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        private readonly CartRepositoryInterface $cartRepository,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly PaymentMethodManagementInterface $paymentManagement,
        private readonly CartManagementInterface $cartManagement,
        private readonly HandlerList $handlerList,
        private readonly MessageInterfaceFactory $messageFactory,
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute(
        string $maskedQuoteId,
        InstrumentInterface $paymentData,
        mixed $riskSignals = null
    ): CheckoutInterface {
        try {
            $quoteId = $this->maskedQuoteIdToQuoteId->execute($maskedQuoteId);
            $cart = $this->cartRepository->getActive($quoteId);
        } catch (Exception) {
            throw new InputException(__('The checkout session with the provided ID does not exist.'));
        }

        $billingAddress = $cart->getBillingAddress();
        $paymentBillingAddress = $paymentData->getBillingAddress();

        if ($paymentBillingAddress !== null) {
            $billingAddress->setFirstname($paymentBillingAddress->getFirstName() ?: $billingAddress->getFirstname());
            $billingAddress->setLastname($paymentBillingAddress->getLastName() ?: $billingAddress->getLastname());
            $billingAddress->setCountryId(
                $paymentBillingAddress->getAddressCountry() ?:
                    $billingAddress->getCountryId()
            );
            $billingAddress->setRegion($paymentBillingAddress->getAddressRegion() ?: $billingAddress->getRegion());
            $billingAddress->setCity($paymentBillingAddress->getAddressLocality() ?: $billingAddress->getCity());
            $billingAddress->setPostcode($paymentBillingAddress->getPostalCode() ?: $billingAddress->getPostcode());
            $billingAddress->setTelephone($paymentBillingAddress->getPhoneNumber() ?: $billingAddress->getTelephone());
            $billingAddress->setStreetFull($paymentBillingAddress->getStreetAddress() ?: $billingAddress->getStreetFull());

            $this->cartRepository->save($cart);
        }

        $messages = [];
        $messageContent = null;
        $order = null;

        try {
            $this->handlerList->handle(
                $paymentData->getHandlerId(),
                $cart,
                $paymentData
            );

            $paymentMethod = $this->paymentManagement->get($quoteId);

            $orderId = (int)$this->cartManagement->placeOrder($quoteId, $paymentMethod);
            $order = $this->orderRepository->get($orderId);
        } catch (LocalizedException $e) {
            $messageContent = $e->getMessage();
        } catch (Exception $e) {
            $this->logger->error(
                sprintf(
                    'Error during checkout completion for quote ID %s: %s',
                    $quoteId,
                    $e->getMessage()
                )
            );

            $messageContent = (string)__(
                'An error occurred while processing your payment.'
            );
        }

        if ($messageContent !== null) {
            /** @var MessageInterface $message */
            $message = $this->messageFactory->create();
            $message->setType(MessageInterface::TYPE_ERROR);
            $message->setSeverity(MessageInterface::SEVERITY_RECOVERABLE);
            $message->setCode(MessageInterface::ERROR_CODE_PAYMENT_DECLINED);
            $message->setContent($messageContent);

            $messages[] = $message;
        }

        return $this->checkoutBuilder->build(
            $maskedQuoteId,
            $cart,
            $messages,
            $order
        );
    }
}
