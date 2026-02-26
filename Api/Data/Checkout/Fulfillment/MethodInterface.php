<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment;

interface MethodInterface
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const LINE_ITEM_IDS = 'line_item_ids';
    public const DESTINATIONS = 'destinations';
    public const SELECTED_DESTINATION_ID = 'selected_destination_id';
    public const GROUPS = 'groups';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string[]
     */
    public function getLineItemIds(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\ShippingDestinationInterface[]|null
     */
    public function getDestinations(): ?array;

    /**
     * @return string|null
     */
    public function getSelectedDestinationId(): ?string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\GroupInterface[]|null
     */
    public function getGroups(): ?array;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * @param string[] $lineItemIds
     * @return self
     */
    public function setLineItemIds(array $lineItemIds): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\ShippingDestinationInterface[]|null $destinations
     * @return self
     */
    public function setDestinations(?array $destinations): self;

    /**
     * @param string|null $selectedDestinationId
     * @return self
     */
    public function setSelectedDestinationId(?string $selectedDestinationId): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\GroupInterface[]|null $groups
     * @return self
     */
    public function setGroups(?array $groups): self;
}
