<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment;

use Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface;

interface ShippingDestinationInterface extends PostalAddressInterface
{
    public const ID = 'id';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;
}
