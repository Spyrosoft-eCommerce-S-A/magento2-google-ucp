<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Fulfillment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\ShippingDestinationInterface;

class ShippingDestination extends DataObject implements ShippingDestinationInterface
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

    public function setId(string $id): ShippingDestinationInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setFirstName(?string $firstName): ShippingDestinationInterface
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    public function setLastName(?string $lastName): ShippingDestinationInterface
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    public function setFullName(?string $fullName): ShippingDestinationInterface
    {
        return $this->setData(self::FULL_NAME, $fullName);
    }

    public function setPostalCode(?string $postalCode): ShippingDestinationInterface
    {
        return $this->setData(self::POSTAL_CODE, $postalCode);
    }

    public function setAddressCountry(?string $addressCountry): ShippingDestinationInterface
    {
        return $this->setData(self::ADDRESS_COUNTRY, $addressCountry);
    }

    public function setAddressRegion(?string $addressRegion): ShippingDestinationInterface
    {
        return $this->setData(self::ADDRESS_REGION, $addressRegion);
    }

    public function setAddressLocality(?string $addressLocality): ShippingDestinationInterface
    {
        return $this->setData(self::ADDRESS_LOCALITY, $addressLocality);
    }

    public function setStreetAddress(?string $streetAddress): ShippingDestinationInterface
    {
        return $this->setData(self::STREET_ADDRESS, $streetAddress);
    }

    public function setExtendedAddress(?string $extendedAddress): ShippingDestinationInterface
    {
        return $this->setData(self::EXTENDED_ADDRESS, $extendedAddress);
    }

    public function setPhoneNumber(?string $phoneNumber): ShippingDestinationInterface
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }
}

