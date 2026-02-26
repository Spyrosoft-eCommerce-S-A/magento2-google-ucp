<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Fulfillment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\MethodInterface;

class Method extends DataObject implements MethodInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getType(): string
    {
        return (string)$this->getData(self::TYPE);
    }

    public function getLineItemIds(): array
    {
        return (array)$this->getData(self::LINE_ITEM_IDS);
    }

    public function getDestinations(): ?array
    {
        return $this->getData(self::DESTINATIONS);
    }

    public function getSelectedDestinationId(): ?string
    {
        return $this->getData(self::SELECTED_DESTINATION_ID);
    }

    public function getGroups(): ?array
    {
        return $this->getData(self::GROUPS);
    }

    public function setId(string $id): MethodInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setType(string $type): MethodInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setLineItemIds(array $lineItemIds): MethodInterface
    {
        return $this->setData(self::LINE_ITEM_IDS, $lineItemIds);
    }

    public function setDestinations(?array $destinations): MethodInterface
    {
        return $this->setData(self::DESTINATIONS, $destinations);
    }

    public function setSelectedDestinationId(?string $selectedDestinationId): MethodInterface
    {
        return $this->setData(self::SELECTED_DESTINATION_ID, $selectedDestinationId);
    }

    public function setGroups(?array $groups): MethodInterface
    {
        return $this->setData(self::GROUPS, $groups);
    }
}
