<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class Payment implements BuilderInterface
{
    public function __construct(
        private readonly PaymentInterfaceFactory $paymentFactory
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        /** @var PaymentInterface $payment */
        $payment = $this->paymentFactory->create();

        $checkout->setPayment($payment);
    }
}
