<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface PostalAddressInterface
{
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FULL_NAME = 'full_name';
    public const POSTAL_CODE = 'postal_code';
    public const ADDRESS_COUNTRY = 'address_country';
    public const ADDRESS_REGION = 'address_region';
    public const ADDRESS_LOCALITY = 'address_locality';
    public const STREET_ADDRESS = 'street_address';
    public const EXTENDED_ADDRESS = 'extended_address';
    public const PHONE_NUMBER = 'phone_number';

    /**
     * @return string|null
     */
    public function getFirstName(): ?string;

    /**
     * @return string|null
     */
    public function getLastName(): ?string;

    /**
     * @return string|null
     */
    public function getFullName(): ?string;

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string;

    /**
     * @return string|null
     */
    public function getAddressCountry(): ?string;

    /**
     * @return string|null
     */
    public function getAddressRegion(): ?string;

    /**
     * @return string|null
     */
    public function getAddressLocality(): ?string;

    /**
     * @return string|null
     */
    public function getStreetAddress(): ?string;

    /**
     * @return string|null
     */
    public function getExtendedAddress(): ?string;

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string;

    /**
     * @param string|null $firstName
     * @return self
     */
    public function setFirstName(?string $firstName): self;

    /**
     * @param string|null $lastName
     * @return self
     */
    public function setLastName(?string $lastName): self;

    /**
     * @param string|null $fullName
     * @return self
     */
    public function setFullName(?string $fullName): self;

    /**
     * @param string|null $postalCode
     * @return self
     */
    public function setPostalCode(?string $postalCode): self;

    /**
     * @param string|null $addressCountry
     * @return self
     */
    public function setAddressCountry(?string $addressCountry): self;

    /**
     * @param string|null $addressRegion
     * @return self
     */
    public function setAddressRegion(?string $addressRegion): self;

    /**
     * @param string|null $addressLocality
     * @return self
     */
    public function setAddressLocality(?string $addressLocality): self;

    /**
     * @param string|null $streetAddress
     * @return self
     */
    public function setStreetAddress(?string $streetAddress): self;

    /**
     * @param string|null $extendedAddress
     * @return self
     */
    public function setExtendedAddress(?string $extendedAddress): self;

    /**
     * @param string|null $phoneNumber
     * @return self
     */
    public function setPhoneNumber(?string $phoneNumber): self;
}
