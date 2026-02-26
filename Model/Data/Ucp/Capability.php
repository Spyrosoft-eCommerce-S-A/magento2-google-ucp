<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Ucp;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Ucp\CapabilityInterface;

class Capability extends DataObject implements CapabilityInterface
{
    public function getName(): string
    {
        return (string)$this->getData(self::NAME);
    }

    public function getVersion(): string
    {
        return (string)$this->getData(self::VERSION);
    }

    public function getSpec(): ?string
    {
        return $this->getData(self::SPEC);
    }

    public function getSchema(): ?string
    {
        return $this->getData(self::SCHEMA);
    }

    public function getExtends(): ?string
    {
        return $this->getData(self::EXTENDS);
    }

    public function getConfig(): ?array
    {
        return $this->getData(self::CONFIG);
    }

    public function setName(string $name): CapabilityInterface
    {
        return $this->setData(self::NAME, $name);
    }

    public function setVersion(string $version): CapabilityInterface
    {
        return $this->setData(self::VERSION, $version);
    }

    public function setSpec(?string $spec): CapabilityInterface
    {
        return $this->setData(self::SPEC, $spec);
    }

    public function setSchema(?string $schema): CapabilityInterface
    {
        return $this->setData(self::SCHEMA, $schema);
    }

    public function setExtends(?string $extends): CapabilityInterface
    {
        return $this->setData(self::EXTENDS, $extends);
    }

    public function setConfig(?array $config): CapabilityInterface
    {
        return $this->setData(self::CONFIG, $config);
    }
}
