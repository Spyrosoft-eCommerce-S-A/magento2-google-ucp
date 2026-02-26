<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment;

interface OptionInterface
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const CARRIER = 'carrier';
    public const EARLIEST_FULFILLMENT_TIME = 'earliest_fulfillment_time';
    public const LATEST_FULFILLMENT_TIME = 'latest_fulfillment_time';
    public const TOTALS = 'totals';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @return string|null
     */
    public function getCarrier(): ?string;

    /**
     * @return string|null
     */
    public function getEarliestFulfillmentTime(): ?string;

    /**
     * @return string|null
     */
    public function getLatestFulfillmentTime(): ?string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[]
     */
    public function getTotals(): array;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self;

    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self;

    /**
     * @param string|null $carrier
     * @return self
     */
    public function setCarrier(?string $carrier): self;

    /**
     * @param string|null $earliestFulfillmentTime
     * @return self
     */
    public function setEarliestFulfillmentTime(?string $earliestFulfillmentTime): self;

    /**
     * @param string|null $latestFulfillmentTime
     * @return self
     */
    public function setLatestFulfillmentTime(?string $latestFulfillmentTime): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[] $totals
     * @return self
     */
    public function setTotals(array $totals): self;
}
