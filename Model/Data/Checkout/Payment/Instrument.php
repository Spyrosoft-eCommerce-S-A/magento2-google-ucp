<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Payment;

use Spyrosoft\Ucp\Api\Data\Checkout\Payment\TokenCredentialInterface;
use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface;

class Instrument extends DataObject implements InstrumentInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getHandlerId(): string
    {
        return (string)$this->getData(self::HANDLER_ID);
    }

    public function getType(): string
    {
        return (string)$this->getData(self::TYPE);
    }

    public function getBillingAddress(): ?PostalAddressInterface
    {
        return $this->getData(self::BILLING_ADDRESS);
    }

    public function getCredential(): ?TokenCredentialInterface
    {
        return $this->getData(self::CREDENTIAL);
    }

    public function getBrand(): string
    {
        return (string)$this->getData(self::BRAND);
    }

    public function getLastDigits(): string
    {
        return (string)$this->getData(self::LAST_DIGITS);
    }

    public function getExpiryMonth(): ?int
    {
        $data = $this->getData(self::EXPIRY_MONTH);
        return $data !== null ? (int)$data : null;
    }

    public function getExpiryYear(): ?int
    {
        $data = $this->getData(self::EXPIRY_YEAR);
        return $data !== null ? (int)$data : null;
    }

    public function getRichTextDescription(): ?string
    {
        return $this->getData(self::RICH_TEXT_DESCRIPTION);
    }

    public function getRichCardArt(): ?string
    {
        return $this->getData(self::RICH_CARD_ART);
    }

    public function setId(string $id): InstrumentInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setHandlerId(string $handlerId): InstrumentInterface
    {
        return $this->setData(self::HANDLER_ID, $handlerId);
    }

    public function setType(string $type): InstrumentInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setBillingAddress(?PostalAddressInterface $billingAddress): InstrumentInterface
    {
        return $this->setData(self::BILLING_ADDRESS, $billingAddress);
    }

    public function setCredential(?TokenCredentialInterface $credential): InstrumentInterface
    {
        return $this->setData(self::CREDENTIAL, $credential);
    }

    public function setBrand(string $brand): InstrumentInterface
    {
        return $this->setData(self::BRAND, $brand);
    }

    public function setLastDigits(string $lastDigits): InstrumentInterface
    {
        return $this->setData(self::LAST_DIGITS, $lastDigits);
    }

    public function setExpiryMonth(?int $expiryMonth): InstrumentInterface
    {
        return $this->setData(self::EXPIRY_MONTH, $expiryMonth);
    }

    public function setExpiryYear(?int $expiryYear): InstrumentInterface
    {
        return $this->setData(self::EXPIRY_YEAR, $expiryYear);
    }

    public function setRichTextDescription(?string $richTextDescription): InstrumentInterface
    {
        return $this->setData(self::RICH_TEXT_DESCRIPTION, $richTextDescription);
    }

    public function setRichCardArt(?string $richCardArt): InstrumentInterface
    {
        return $this->setData(self::RICH_CARD_ART, $richCardArt);
    }
}
