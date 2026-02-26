<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Model\Config\Source\ProductId;
use Spyrosoft\Ucp\Service\Config;
use Spyrosoft\Ucp\Service\Util\ConvertAmount;

class LineItems implements BuilderInterface
{
    private const TOTALS_MAPPING = [
        TotalInterface::TYPE_ITEMS_DISCOUNT => 'discount_amount',
        TotalInterface::TYPE_TAX => 'tax_amount',
        TotalInterface::TYPE_TOTAL => 'row_total_incl_tax'
    ];

    public function __construct(
        private readonly LineItemInterfaceFactory $lineItemFactory,
        private readonly ItemInterfaceFactory $itemFactory,
        private readonly TotalInterfaceFactory $totalFactory,
        private readonly Config $config
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
        $productIdField = $this->config->getProductIdentifier();

        /** @var Quote\Item $quoteItem */
        foreach ($quote->getAllVisibleItems() as $quoteItem) {
            if ($quoteItem->getParentItemId()) {
                continue;
            }

            /** @var LineItemInterface $lineItem */
            $lineItem = $this->lineItemFactory->create();
            /** @var ItemInterface $item */
            $item = $this->itemFactory->create();

            $item->setId(
                (string)(
                    $productIdField === ProductId::VALUE_ID ?
                        $quoteItem->getProductId() : $quoteItem->getSku()
                )
            );
            $item->setTitle((string)$quoteItem->getName());
            $item->setPrice(
                ConvertAmount::convert(
                    (float)$quoteItem->getPriceInclTax()
                )
            );

            $lineItem->setId((string)$quoteItem->getItemId());
            $lineItem->setQuantity((int)$quoteItem->getQty());
            $lineItem->setItem($item);

            $totals = [];

            foreach (self::TOTALS_MAPPING as $type => $field) {
                if ((float)$quoteItem->getData($field) <= 0) {
                    continue;
                }

                /** @var TotalInterface $total */
                $total = $this->totalFactory->create();
                $total->setType($type);
                $total->setAmount(
                    ConvertAmount::convert(
                        (float)$quoteItem->getData($field)
                    )
                );

                $totals[] = $total;
            }
            $lineItem->setTotals($totals);

            $result[] = $lineItem;
        }

        $checkout->setLineItems($result);
    }
}
