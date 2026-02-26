<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder;

use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterfaceFactory;
use Spyrosoft\Ucp\Service\Payment\HandlerList;

class Payment
{
    public function __construct(
        private readonly PaymentInterfaceFactory $paymentFactory,
        private readonly HandlerList $handlerList,
    ) {
    }

    public function build(): PaymentInterface
    {
        /** @var PaymentInterface $payment */
        $payment = $this->paymentFactory->create();

        $payment->setHandlers($this->handlerList->execute());

        return $payment;
    }
}
