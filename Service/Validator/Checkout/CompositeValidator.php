<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class CompositeValidator implements ValidatorInterface
{
    /**
     * @param ValidatorInterface[] $validators
     */
    public function __construct(
        private readonly array $validators = []
    ) {
    }

    public function validate(CartInterface $quote, CheckoutInterface $checkout): array
    {
        $result = [];

        foreach ($this->validators as $validator) {
            $result[] = $validator->validate($quote, $checkout);
        }

        return array_merge([], ...$result);
    }
}
