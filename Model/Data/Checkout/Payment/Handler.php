<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\Payment;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface;

class Handler extends DataObject implements HandlerInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getName(): string
    {
        return (string)$this->getData(self::NAME);
    }

    public function getVersion(): string
    {
        return (string)$this->getData(self::VERSION);
    }

    public function getSpec(): string
    {
        return (string)$this->getData(self::SPEC);
    }

    public function getConfigSchema(): string
    {
        return (string)$this->getData(self::CONFIG_SCHEMA);
    }

    public function getInstrumentSchemas(): array
    {
        return (array)$this->getData(self::INSTRUMENT_SCHEMAS);
    }

    public function getConfig(): array
    {
        return (array)$this->getData(self::CONFIG);
    }

    public function setId(string $id): HandlerInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setName(string $name): HandlerInterface
    {
        return $this->setData(self::NAME, $name);
    }

    public function setVersion(string $version): HandlerInterface
    {
        return $this->setData(self::VERSION, $version);
    }

    public function setSpec(string $spec): HandlerInterface
    {
        return $this->setData(self::SPEC, $spec);
    }

    public function setConfigSchema(string $configSchema): HandlerInterface
    {
        return $this->setData(self::CONFIG_SCHEMA, $configSchema);
    }

    public function setInstrumentSchemas(array $instrumentSchemas): HandlerInterface
    {
        return $this->setData(self::INSTRUMENT_SCHEMAS, $instrumentSchemas);
    }

    public function setConfig(array $config): HandlerInterface
    {
        return $this->setData(self::CONFIG, $config);
    }
}

