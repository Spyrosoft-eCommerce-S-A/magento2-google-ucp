<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Payment;

interface TokenCredentialInterface
{
    public const TYPE = 'type';
    public const TOKEN = 'token';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * @param string $token
     * @return self
     */
    public function setToken(string $token): self;
}
