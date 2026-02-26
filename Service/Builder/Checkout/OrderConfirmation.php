<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class OrderConfirmation implements BuilderInterface
{
    public function __construct(
        private readonly OrderConfirmationInterfaceFactory $orderConfirmationFactory
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        if (!$order instanceof OrderInterface) {
            return;
        }

        /** @var OrderConfirmationInterface $orderConfirmation */
        $orderConfirmation = $this->orderConfirmationFactory->create();
        $orderConfirmation->setId($order->getIncrementId());
        $orderConfirmation->setPermalinkUrl('');

        $checkout->setOrder($orderConfirmation);
    }
}
