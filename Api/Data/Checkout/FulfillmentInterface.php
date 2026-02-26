<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface FulfillmentInterface
{
    public const METHODS = 'methods';
    public const AVAILABLE_METHODS = 'available_methods';

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\MethodInterface[]
     */
    public function getMethods(): array;

    /**
     * @return array|null
     */
    public function getAvailableMethods(): ?array;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\MethodInterface[] $methods
     * @return self
     */
    public function setMethods(array $methods): self;

    /**
     * @param array|null $methods
     * @return self
     */
    public function setAvailableMethods(?array $availableMethods): self;
}
