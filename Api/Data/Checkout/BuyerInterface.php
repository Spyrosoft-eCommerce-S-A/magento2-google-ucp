<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface BuyerInterface
{
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FULL_NAME = 'full_name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self;

    /**
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self;

    /**
     * @param string $fullName
     * @return self
     */
    public function setFullName(string $fullName): self;

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self;

    /**
     * @param string $phoneNumber
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self;
}
