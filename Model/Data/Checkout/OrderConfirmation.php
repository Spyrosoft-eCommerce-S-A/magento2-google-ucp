<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface;

class OrderConfirmation extends DataObject implements OrderConfirmationInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getPermalinkUrl(): string
    {
        return (string)$this->getData(self::PERMALINK_URL);
    }

    public function setId(string $id): OrderConfirmationInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setPermalinkUrl(string $permalinkUrl): OrderConfirmationInterface
    {
        return $this->setData(self::PERMALINK_URL, $permalinkUrl);
    }
}
