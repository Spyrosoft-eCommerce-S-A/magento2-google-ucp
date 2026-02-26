<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Api\Data\Checkout\PostalAddressInterface;
use Spyrosoft\Ucp\Model\DataObject;

class PostalAddress extends DataObject implements PostalAddressInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getFirstName(): ?string
    {
        return $this->getData(self::FIRST_NAME);
    }

    public function getLastName(): ?string
    {
        return $this->getData(self::LAST_NAME);
    }

    public function getFullName(): ?string
    {
        return $this->getData(self::FULL_NAME);
    }

    public function getPostalCode(): ?string
    {
        return $this->getData(self::POSTAL_CODE);
    }

    public function getAddressCountry(): ?string
    {
        return $this->getData(self::ADDRESS_COUNTRY);
    }

    public function getAddressRegion(): ?string
    {
        return $this->getData(self::ADDRESS_REGION);
    }

    public function getAddressLocality(): ?string
    {
        return $this->getData(self::ADDRESS_LOCALITY);
    }

    public function getStreetAddress(): ?string
    {
        return $this->getData(self::STREET_ADDRESS);
    }

    public function getExtendedAddress(): ?string
    {
        return $this->getData(self::EXTENDED_ADDRESS);
    }

    public function getPhoneNumber(): ?string
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    public function setId(string $id): PostalAddressInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setFirstName(?string $firstName): PostalAddressInterface
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    public function setLastName(?string $lastName): PostalAddressInterface
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    public function setFullName(?string $fullName): PostalAddressInterface
    {
        return $this->setData(self::FULL_NAME, $fullName);
    }

    public function setPostalCode(?string $postalCode): PostalAddressInterface
    {
        return $this->setData(self::POSTAL_CODE, $postalCode);
    }

    public function setAddressCountry(?string $addressCountry): PostalAddressInterface
    {
        return $this->setData(self::ADDRESS_COUNTRY, $addressCountry);
    }

    public function setAddressRegion(?string $addressRegion): PostalAddressInterface
    {
        return $this->setData(self::ADDRESS_REGION, $addressRegion);
    }

    public function setAddressLocality(?string $addressLocality): PostalAddressInterface
    {
        return $this->setData(self::ADDRESS_LOCALITY, $addressLocality);
    }

    public function setStreetAddress(?string $streetAddress): PostalAddressInterface
    {
        return $this->setData(self::STREET_ADDRESS, $streetAddress);
    }

    public function setExtendedAddress(?string $extendedAddress): PostalAddressInterface
    {
        return $this->setData(self::EXTENDED_ADDRESS, $extendedAddress);
    }

    public function setPhoneNumber(?string $phoneNumber): PostalAddressInterface
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }
}

