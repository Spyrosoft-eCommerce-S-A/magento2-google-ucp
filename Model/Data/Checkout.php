<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data;

use Spyrosoft\Ucp\Api\Data\Checkout\OrderConfirmationInterface;
use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Api\Data\UcpInterface;

class Checkout extends DataObject implements CheckoutInterface
{
    public function getUcp(): UcpInterface
    {
        return $this->getData(self::UCP);
    }

    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getLineItems(): array
    {
        return $this->getData(self::LINE_ITEMS);
    }

    public function getBuyer(): ?BuyerInterface
    {
        return $this->getData(self::BUYER);
    }

    public function getStatus(): string
    {
        return (string)$this->getData(self::STATUS);
    }

    public function getCurrency(): string
    {
        return (string)$this->getData(self::CURRENCY);
    }

    public function getTotals(): array
    {
        return $this->getData(self::TOTALS);
    }

    public function getMessages(): array
    {
        return $this->getData(self::MESSAGES);
    }

    public function getLinks(): array
    {
        return $this->getData(self::LINKS);
    }

    public function getExpiresAt(): string
    {
        return (string)$this->getData(self::EXPIRES_AT);
    }

    public function getContinueUrl(): string
    {
        return (string)$this->getData(self::CONTINUE_URL);
    }

    public function getPayment(): PaymentInterface
    {
        return $this->getData(self::PAYMENT);
    }

    public function getOrder(): ?OrderConfirmationInterface
    {
        return $this->getData(self::ORDER);
    }

    public function getFulfillment(): ?FulfillmentInterface
    {
        return $this->getData(self::FULFILLMENT);
    }

    public function getSelectedFulfillmentOption(): ?string
    {
        return $this->getData(self::SELECTED_FULFILLMENT_OPTION);
    }

    public function setUcp(UcpInterface $ucp): CheckoutInterface
    {
        return $this->setData(self::UCP, $ucp);
    }

    public function setId(string $id): CheckoutInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setLineItems(array $lineItems): CheckoutInterface
    {
        return $this->setData(self::LINE_ITEMS, $lineItems);
    }

    public function setBuyer(?BuyerInterface $buyer): CheckoutInterface
    {
        return $this->setData(self::BUYER, $buyer);
    }

    public function setStatus(string $status): CheckoutInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setCurrency(string $currency): CheckoutInterface
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    public function setTotals(array $totals): CheckoutInterface
    {
        return $this->setData(self::TOTALS, $totals);
    }

    public function setMessages(array $messages): CheckoutInterface
    {
        return $this->setData(self::MESSAGES, $messages);
    }

    public function setLinks(array $links): CheckoutInterface
    {
        return $this->setData(self::LINKS, $links);
    }

    public function setExpiresAt(string $expiresAt): CheckoutInterface
    {
        return $this->setData(self::EXPIRES_AT, $expiresAt);
    }

    public function setContinueUrl(string $continueUrl): CheckoutInterface
    {
        return $this->setData(self::CONTINUE_URL, $continueUrl);
    }

    public function setPayment(PaymentInterface $payment): CheckoutInterface
    {
        return $this->setData(self::PAYMENT, $payment);
    }

    public function setOrder(?OrderConfirmationInterface $order): CheckoutInterface
    {
        return $this->setData(self::ORDER, $order);
    }

    public function setFulfillment(?FulfillmentInterface $fulfillment): CheckoutInterface
    {
        return $this->setData(self::FULFILLMENT, $fulfillment);
    }

    public function setSelectedFulfillmentOption(?string $selectedFulfillmentOption): CheckoutInterface
    {
        return $this->setData(self::SELECTED_FULFILLMENT_OPTION, $selectedFulfillmentOption);
    }
}
