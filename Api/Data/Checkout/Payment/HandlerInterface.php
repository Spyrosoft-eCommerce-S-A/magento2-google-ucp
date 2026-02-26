<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\Payment;

interface HandlerInterface
{
    public const ID = 'id';
    public const NAME = 'name';
    public const VERSION = 'version';
    public const SPEC = 'spec';
    public const CONFIG_SCHEMA = 'config_schema';
    public const INSTRUMENT_SCHEMAS = 'instrument_schemas';
    public const CONFIG = 'config';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return string
     */
    public function getSpec(): string;

    /**
     * @return string
     */
    public function getConfigSchema(): string;

    /**
     * @return string[]
     */
    public function getInstrumentSchemas(): array;

    /**
     * @return array
     */
    public function getConfig(): array;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * @param string $version
     * @return self
     */
    public function setVersion(string $version): self;

    /**
     * @param string $spec
     * @return self
     */
    public function setSpec(string $spec): self;

    /**
     * @param string $configSchema
     * @return self
     */
    public function setConfigSchema(string $configSchema): self;

    /**
     * @param string[] $instrumentSchemas
     * @return self
     */
    public function setInstrumentSchemas(array $instrumentSchemas): self;

    /**
     * @param array $config
     * @return self
     */
    public function setConfig(array $config): self;
}
