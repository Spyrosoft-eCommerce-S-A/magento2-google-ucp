<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;

class Buyer extends DataObject implements BuyerInterface
{
    public function getFirstName(): string
    {
        return (string)$this->getData(self::FIRST_NAME);
    }

    public function getLastName(): string
    {
        return (string)$this->getData(self::LAST_NAME);
    }

    public function getFullName(): string
    {
        return (string)$this->getData(self::FULL_NAME);
    }

    public function getEmail(): string
    {
        return (string)$this->getData(self::EMAIL);
    }

    public function getPhoneNumber(): string
    {
        return (string)$this->getData(self::PHONE_NUMBER);
    }

    public function setFirstName(string $firstName): BuyerInterface
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    public function setLastName(string $lastName): BuyerInterface
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    public function setFullName(string $fullName): BuyerInterface
    {
        return $this->setData(self::FULL_NAME, $fullName);
    }

    public function setEmail(string $email): BuyerInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setPhoneNumber(string $phoneNumber): BuyerInterface
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }
}
