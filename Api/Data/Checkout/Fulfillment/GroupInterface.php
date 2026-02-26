<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment;

interface GroupInterface
{
    public const ID = 'id';
    public const LINE_ITEM_IDS = 'line_item_ids';
    public const OPTIONS = 'options';
    public const SELECTED_OPTION_ID = 'selected_option_id';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string[]
     */
    public function getLineItemIds(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\OptionInterface[]|null
     */
    public function getOptions(): ?array;

    /**
     * @return string|null
     */
    public function getSelectedOptionId(): ?string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string[] $lineItemIds
     * @return self
     */
    public function setLineItemIds(array $lineItemIds): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\OptionInterface[]|null $options
     * @return self
     */
    public function setOptions(?array $options): self;

    /**
     * @param string|null $selectedOptionId
     * @return self
     */
    public function setSelectedOptionId(?string $selectedOptionId): self;
}
