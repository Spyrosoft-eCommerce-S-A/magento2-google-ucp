<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface;

class Total extends DataObject implements TotalInterface
{
    public function getType(): string
    {
        return (string)$this->getData(self::TYPE);
    }

    public function getDisplayText(): ?string
    {
        return $this->getData(self::DISPLAY_TEXT);
    }

    public function getAmount(): int
    {
        return (int)$this->getData(self::AMOUNT);
    }

    public function setType(string $type): TotalInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setDisplayText(?string $displayText): TotalInterface
    {
        return $this->setData(self::DISPLAY_TEXT, $displayText);
    }

    public function setAmount(int $amount): TotalInterface
    {
        return $this->setData(self::AMOUNT, $amount);
    }
}
