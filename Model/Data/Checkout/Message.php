<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;

class Message extends DataObject implements MessageInterface
{
    public function getType(): ?string
    {
        return $this->getData(self::TYPE);
    }

    public function getCode(): ?string
    {
        return $this->getData(self::CODE);
    }

    public function getPath(): ?string
    {
        return $this->getData(self::PATH);
    }

    public function getContentType(): ?string
    {
        return $this->getData(self::CONTENT_TYPE) ?: MessageInterface::CONTENT_TYPE_PLAIN;
    }

    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    public function getSeverity(): ?string
    {
        return $this->getData(self::SEVERITY);
    }

    public function setType(?string $type): MessageInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    public function setCode(?string $code): MessageInterface
    {
        return $this->setData(self::CODE, $code);
    }

    public function setPath(?string $path): MessageInterface
    {
        return $this->setData(self::PATH, $path);
    }

    public function setContentType(?string $contentType): MessageInterface
    {
        return $this->setData(self::CONTENT_TYPE, $contentType);
    }

    public function setContent(?string $content): MessageInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    public function setSeverity(?string $severity): MessageInterface
    {
        return $this->setData(self::SEVERITY, $severity);
    }
}

