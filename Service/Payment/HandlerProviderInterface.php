<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Service\Payment;

use Magento\Quote\Api\Data\CartInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;

interface HandlerProviderInterface
{
    public function getHandler(): ?HandlerInterface;

    public function handle(CartInterface $quote, InstrumentInterface $paymentData): void;
}
