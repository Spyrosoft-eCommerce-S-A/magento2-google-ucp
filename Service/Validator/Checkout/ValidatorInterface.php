<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Service\Validator\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

interface ValidatorInterface
{
    /**
     * @param CartInterface $quote
     * @param CheckoutInterface $checkout
     * @return MessageInterface[]
     */
    public function validate(CartInterface $quote, CheckoutInterface $checkout): array;
}
