<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Magento\QuoteGraphQl\Model\Cart\TotalsCollector;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Store\Model\ScopeInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\GroupInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\GroupInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\MethodInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\MethodInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\OptionInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\OptionInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Builder\Checkout\Fulfillment\Destinations;
use Spyrosoft\Ucp\Service\Util\ConvertAmount;

class Fulfillment implements BuilderInterface
{
    public function __construct(
        private readonly FulfillmentInterfaceFactory $fulfillmentFactory,
        private readonly MethodInterfaceFactory $methodFactory,
        private readonly GroupInterfaceFactory $groupFactory,
        private readonly OptionInterfaceFactory $optionFactory,
        private readonly TotalInterfaceFactory $totalFactory,
        private readonly Destinations $destinationsBuilder,
        private readonly TotalsCollector $totalsCollector,
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        /** @var Quote $quote */
        if ($quote->getIsVirtual() || empty($checkout->getLineItems())) {
            return;
        }

        $address = $quote->getShippingAddress();

        if (!$address->getCountryId()) {
            $address->setCountryId(
                $address->getCountryCode() ?: $this->getDefaultCountry()
            );
        }

        $address->setCollectShippingRates(true);
        $this->totalsCollector->collectAddressTotals(
            $quote,
            $address
        );

        $selectedMethod = $address->getShippingMethod();

        /** @var FulfillmentInterface $fulfillment */
        $fulfillment = $this->fulfillmentFactory->create();

        $shippingRates = $address->getGroupedAllShippingRates();

        $lineItemIds = array_map(
            fn ($item) => $item->getId(),
            $checkout->getLineItems()
        );

        /** @var MethodInterface $shippingMethod */
        $shippingMethod = $this->methodFactory->create();
        $shippingMethod->setId('shipping');
        $shippingMethod->setType('shipping');
        $shippingMethod->setLineItemIds($lineItemIds);
        $shippingMethod->setDestinations(
            $this->destinationsBuilder->build($quote)
        );

        if (!empty($shippingMethod->getDestinations())) {
            $shippingMethod->setSelectedDestinationId(
                $shippingMethod->getDestinations()[0]->getId()
            );
        }

        /** @var GroupInterface $shippingMethodGroup */
        $shippingMethodGroup = $this->groupFactory->create();
        $shippingMethodGroup->setId('shipping');
        $shippingMethodGroup->setLineItemIds($lineItemIds);

        $shippingMethodGroupOptions = [];

        foreach ($shippingRates as $carrierRates) {
            /** @var Quote\Address\Rate $rate */
            foreach ($carrierRates as $rate) {
                $id = $rate->getCarrier() . '_' . $rate->getMethod();

                if ($id === $selectedMethod) {
                    $shippingMethodGroup->setSelectedOptionId($id);
                }

                /** @var OptionInterface $option */
                $option = $this->optionFactory->create();
                $option->setId($id);
                $option->setTitle($rate->getMethodTitle());
                $option->setCarrier($rate->getCarrierTitle());

                /** @var TotalInterface $total */
                $total = $this->totalFactory->create();
                $total->setType(TotalInterface::TYPE_TOTAL);
                $total->setAmount(
                    ConvertAmount::convert(
                        (float)$rate->getPrice()
                    )
                );
                $option->setTotals([$total]);

                $shippingMethodGroupOptions[] = $option;
            }
        }

        $shippingMethodGroup->setOptions($shippingMethodGroupOptions);
        $shippingMethod->setGroups([$shippingMethodGroup]);

        $fulfillment->setMethods([$shippingMethod]);

        $checkout->setFulfillment($fulfillment);

        if ($selectedMethod) {
            $checkout->setSelectedFulfillmentOption($selectedMethod);
        }
    }

    private function getDefaultCountry(): string
    {
        return (string)$this->scopeConfig->getValue(
            'general/country/default',
            ScopeInterface::SCOPE_STORE
        );
    }
}
