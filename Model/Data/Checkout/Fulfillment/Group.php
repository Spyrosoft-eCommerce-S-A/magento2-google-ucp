<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Fulfillment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\GroupInterface;

class Group extends DataObject implements GroupInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getLineItemIds(): array
    {
        return (array)$this->getData(self::LINE_ITEM_IDS);
    }

    public function getOptions(): ?array
    {
        return $this->getData(self::OPTIONS);
    }

    public function getSelectedOptionId(): ?string
    {
        return $this->getData(self::SELECTED_OPTION_ID);
    }

    public function setId(string $id): GroupInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setLineItemIds(array $lineItemIds): GroupInterface
    {
        return $this->setData(self::LINE_ITEM_IDS, $lineItemIds);
    }

    public function setOptions(?array $options): GroupInterface
    {
        return $this->setData(self::OPTIONS, $options);
    }

    public function setSelectedOptionId(?string $selectedOptionId): GroupInterface
    {
        return $this->setData(self::SELECTED_OPTION_ID, $selectedOptionId);
    }
}

