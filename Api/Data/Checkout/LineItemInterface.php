<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

use Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface;

interface LineItemInterface
{
    public const ID = 'id';
    public const ITEM = 'item';
    public const QUANTITY = 'quantity';
    public const TOTALS = 'totals';
    public const PARENT_ID = 'parent_id';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface
     */
    public function getItem(): ItemInterface;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[]
     */
    public function getTotals(): array;

    /**
     * @return string|null
     */
    public function getParentId(): ?string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface $item
     * @return self
     */
    public function setItem(ItemInterface $item): self;

    /**
     * @param int $quantity
     * @return self
     */
    public function setQuantity(int $quantity): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[] $totals
     * @return self
     */
    public function setTotals(array $totals): self;

    /**
     * @param string|null $parentId
     * @return self
     */
    public function setParentId(?string $parentId): self;
}
