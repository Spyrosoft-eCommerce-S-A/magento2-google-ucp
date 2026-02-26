<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;

class LineItem extends DataObject implements LineItemInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getItem(): ItemInterface
    {
        return $this->getData(self::ITEM);
    }

    public function getQuantity(): int
    {
        return (int)$this->getData(self::QUANTITY);
    }

    public function getTotals(): array
    {
        return (array)$this->getData(self::TOTALS);
    }

    public function getParentId(): ?string
    {
        return $this->getData(self::PARENT_ID);
    }

    public function setId(string $id): LineItemInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setItem(ItemInterface $item): LineItemInterface
    {
        return $this->setData(self::ITEM, $item);
    }

    public function setQuantity(int $quantity): LineItemInterface
    {
        return $this->setData(self::QUANTITY, $quantity);
    }

    public function setTotals(array $totals): LineItemInterface
    {
        return $this->setData(self::TOTALS, $totals);
    }

    public function setParentId(?string $parentId): LineItemInterface
    {
        return $this->setData(self::PARENT_ID, $parentId);
    }
}
