<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface TotalInterface
{
    public const TYPE = 'type';
    public const DISPLAY_TEXT = 'display_text';
    public const AMOUNT = 'amount';

    public const TYPE_DISCOUNT = 'discount';
    public const TYPE_FEE = 'fee';
    public const TYPE_FULFILLMENT = 'fulfillment';
    public const TYPE_ITEMS_DISCOUNT = 'items_discount';
    public const TYPE_SUBTOTAL = 'subtotal';
    public const TYPE_TAX = 'tax';
    public const TYPE_TOTAL = 'total';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string|null
     */
    public function getDisplayText(): ?string;

    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * @param string|null $displayText
     * @return self
     */
    public function setDisplayText(?string $displayText): self;

    /**
     * @param int $amount
     * @return self
     */
    public function setAmount(int $amount): self;
}
