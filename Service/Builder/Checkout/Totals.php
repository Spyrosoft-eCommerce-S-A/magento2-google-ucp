<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Magento\QuoteGraphQl\Model\Cart\TotalsCollector;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Util\ConvertAmount;

class Totals implements BuilderInterface
{
    private const TOTALS_MAPPING = [
        TotalInterface::TYPE_DISCOUNT => 'discount',
        TotalInterface::TYPE_SUBTOTAL => 'subtotal',
        TotalInterface::TYPE_TAX => 'tax'
    ];

    public function __construct(
        private readonly TotalInterfaceFactory $totalFactory,
        private readonly TotalsCollector $totalsCollector
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        /** @var Quote $quote */
        $result = [];
        $totals = $this->totalsCollector->collectQuoteTotals($quote);

        foreach (self::TOTALS_MAPPING as $type => $field) {
            if ((float)$totals->getTotalAmount($field) <= 0) {
                continue;
            }

            /** @var TotalInterface $total */
            $total = $this->totalFactory->create();
            $total->setType($type);
            $total->setAmount(
                ConvertAmount::convert(
                    (float)$totals->getTotalAmount($field)
                )
            );

            $result[] = $total;
        }

        if (!$quote->isVirtual()) {
            $shippingAddress = $quote->getShippingAddress();

            if ($shippingAddress->getShippingInclTax()) {
                /** @var TotalInterface $shippingTotal */
                $shippingTotal = $this->totalFactory->create();
                $shippingTotal->setType(TotalInterface::TYPE_FULFILLMENT);
                $shippingTotal->setAmount(
                    ConvertAmount::convert(
                        (float)$shippingAddress->getShippingInclTax()
                    )
                );
                $result[] = $shippingTotal;
            }
        }

        /** @var TotalInterface $grandTotal */
        $grandTotal = $this->totalFactory->create();
        $grandTotal->setType(TotalInterface::TYPE_TOTAL);
        $grandTotal->setAmount(
            ConvertAmount::convert(
                (float)$quote->getGrandTotal()
            )
        );
        $result[] = $grandTotal;

        $checkout->setTotals($result);
    }
}
