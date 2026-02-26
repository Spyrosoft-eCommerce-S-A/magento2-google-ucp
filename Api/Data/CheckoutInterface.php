<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data;

use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;

interface CheckoutInterface
{
    public const UCP = 'ucp';
    public const ID = 'id';
    public const LINE_ITEMS = 'line_items';
    public const BUYER = 'buyer';
    public const STATUS = 'status';
    public const CURRENCY = 'currency';
    public const TOTALS = 'totals';
    public const MESSAGES = 'messages';
    public const LINKS = 'links';
    public const EXPIRES_AT = 'expires_at';
    public const CONTINUE_URL = 'continue_url';
    public const PAYMENT = 'payment';
    public const ORDER = 'order';
    public const FULFILLMENT = 'fulfillment';
    public const SELECTED_FULFILLMENT_OPTION = 'selected_fulfillment_option';

    /**
     * @return \Spyrosoft\Ucp\Api\Data\UcpInterface
     */
    public function getUcp(): UcpInterface;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface[]
     */
    public function getLineItems(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface|null
     */
    public function getBuyer(): ?BuyerInterface;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return string
     */
    public function getCurrency(): string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[]
     */
    public function getTotals(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface[]
     */
    public function getMessages(): array;

    /**
     * @return array
     */
    public function getLinks(): array;

    /**
     * @return string
     */
    public function getExpiresAt(): string;

    /**
     * @return string
     */
    public function getContinueUrl(): string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface
     */
    public function getPayment(): PaymentInterface;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface|null
     */
    public function getOrder(): ?OrderConfirmationInterface;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface|null
     */
    public function getFulfillment(): ?FulfillmentInterface;

    /**
     * @return string|null
     */
    public function getSelectedFulfillmentOption(): ?string;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\UcpInterface $ucp
     * @return self
     */
    public function setUcp(UcpInterface $ucp): self;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface[] $lineItems
     * @return self
     */
    public function setLineItems(array $lineItems): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface|null $buyer
     * @return self
     */
    public function setBuyer(?BuyerInterface $buyer): self;

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self;

    /**
     * @param string $currency
     * @return self
     */
    public function setCurrency(string $currency): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\TotalInterface[] $totals
     * @return self
     */
    public function setTotals(array $totals): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface[] $messages
     * @return self
     */
    public function setMessages(array $messages): self;

    /**
     * @param array $links
     * @return self
     */
    public function setLinks(array $links): self;

    /**
     * @param string $expiresAt
     * @return self
     */
    public function setExpiresAt(string $expiresAt): self;

    /**
     * @param string $continueUrl
     * @return self
     */
    public function setContinueUrl(string $continueUrl): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface $payment
     * @return self
     */
    public function setPayment(PaymentInterface $payment): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface|null $order
     * @return self
     */
    public function setOrder(?OrderConfirmationInterface $order): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface|null $fulfillment
     * @return self
     */
    public function setFulfillment(?FulfillmentInterface $fulfillment): self;

    /**
     * @param string|null $selectedFulfillmentOption
     * @return self
     */
    public function setSelectedFulfillmentOption(?string $selectedFulfillmentOption): self;
}
