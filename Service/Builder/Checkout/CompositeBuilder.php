<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class CompositeBuilder implements BuilderInterface
{
    public function __construct(
        private readonly array $builders = []
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        foreach ($this->builders as $builder) {
            if (!$builder instanceof BuilderInterface) {
                continue;
            }

            $builder->build($quote, $checkout, $order);
        }
    }
}
