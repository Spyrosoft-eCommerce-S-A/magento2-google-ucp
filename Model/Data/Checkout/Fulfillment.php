<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;

class Fulfillment extends DataObject implements FulfillmentInterface
{
    public function getMethods(): array
    {
        return (array)$this->getData(self::METHODS);
    }

    public function getAvailableMethods(): ?array
    {
        return $this->getData(self::AVAILABLE_METHODS);
    }

    public function setMethods(array $methods): FulfillmentInterface
    {
        return $this->setData(self::METHODS, $methods);
    }

    public function setAvailableMethods(?array $availableMethods): FulfillmentInterface
    {
        return $this->setData(self::AVAILABLE_METHODS, $availableMethods);
    }
}
