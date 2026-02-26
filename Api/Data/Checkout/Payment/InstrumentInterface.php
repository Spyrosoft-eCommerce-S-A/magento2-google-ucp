<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Payment;

use Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface;

interface InstrumentInterface
{
    public const ID = 'id';
    public const HANDLER_ID = 'handler_id';
    public const TYPE = 'type';
    public const BILLING_ADDRESS = 'billing_address';
    public const CREDENTIAL = 'credential';
    public const BRAND = 'brand';
    public const LAST_DIGITS = 'last_digits';
    public const EXPIRY_MONTH = 'expiry_month';
    public const EXPIRY_YEAR = 'expiry_year';
    public const RICH_TEXT_DESCRIPTION = 'rich_text_description';
    public const RICH_CARD_ART = 'rich_card_art';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getHandlerId(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface|null
     */
    public function getBillingAddress(): ?PostalAddressInterface;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Payment\TokenCredentialInterface|null
     */
    public function getCredential(): ?TokenCredentialInterface;

    /**
     * @return string
     */
    public function getBrand(): string;

    /**
     * @return string
     */
    public function getLastDigits(): string;

    /**
     * @return int|null
     */
    public function getExpiryMonth(): ?int;

    /**
     * @return int|null
     */
    public function getExpiryYear(): ?int;

    /**
     * @return string|null
     */
    public function getRichTextDescription(): ?string;

    /**
     * @return string|null
     */
    public function getRichCardArt(): ?string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string $handlerId
     * @return self
     */
    public function setHandlerId(string $handlerId): self;

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface|null $billingAddress
     * @return self
     */
    public function setBillingAddress(?PostalAddressInterface $billingAddress): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Payment\TokenCredentialInterface|null $credential
     * @return self
     */
    public function setCredential(?TokenCredentialInterface $credential): self;

    /**
     * @param string $brand
     * @return self
     */
    public function setBrand(string $brand): self;

    /**
     * @param string $lastDigits
     * @return self
     */
    public function setLastDigits(string $lastDigits): self;

    /**
     * @param int|null $expiryMonth
     * @return self
     */
    public function setExpiryMonth(?int $expiryMonth): self;

    /**
     * @param int|null $expiryYear
     * @return self
     */
    public function setExpiryYear(?int $expiryYear): self;

    /**
     * @param string|null $richTextDescription
     * @return self
     */
    public function setRichTextDescription(?string $richTextDescription): self;

    /**
     * @param string|null $richCardArt
     * @return self
     */
    public function setRichCardArt(?string $richCardArt): self;
}
