<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Payment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\TokenCredentialInterface;

class TokenCredential extends DataObject implements TokenCredentialInterface
{
    public function getType(): string
    {
        return (string)$this->getData(self::TYPE);
    }

    public function getToken(): string
    {
        return (string)$this->getData(self::TOKEN);
    }

    public function setType(string $type): TokenCredentialInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setToken(string $token): TokenCredentialInterface
    {
        return $this->setData(self::TOKEN, $token);
    }
}
