<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Fulfillment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\OptionInterface;

class Option extends DataObject implements OptionInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getTitle(): string
    {
        return (string)$this->getData(self::TITLE);
    }

    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getCarrier(): ?string
    {
        return $this->getData(self::CARRIER);
    }

    public function getEarliestFulfillmentTime(): ?string
    {
        return $this->getData(self::EARLIEST_FULFILLMENT_TIME);
    }

    public function getLatestFulfillmentTime(): ?string
    {
        return $this->getData(self::LATEST_FULFILLMENT_TIME);
    }

    public function getTotals(): array
    {
        return (array)$this->getData(self::TOTALS);
    }

    public function setId(string $id): OptionInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setTitle(string $title): OptionInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    public function setDescription(?string $description): OptionInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function setCarrier(?string $carrier): OptionInterface
    {
        return $this->setData(self::CARRIER, $carrier);
    }

    public function setEarliestFulfillmentTime(?string $earliestFulfillmentTime): OptionInterface
    {
        return $this->setData(self::EARLIEST_FULFILLMENT_TIME, $earliestFulfillmentTime);
    }

    public function setLatestFulfillmentTime(?string $latestFulfillmentTime): OptionInterface
    {
        return $this->setData(self::LATEST_FULFILLMENT_TIME, $latestFulfillmentTime);
    }

    public function setTotals(array $totals): OptionInterface
    {
        return $this->setData(self::TOTALS, $totals);
    }
}

