<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Ucp;

interface CapabilityInterface
{
    public const NAME = 'name';
    public const VERSION = 'version';
    public const SPEC = 'spec';
    public const SCHEMA = 'schema';
    public const EXTENDS = 'extends';
    public const CONFIG = 'config';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return string|null
     */
    public function getSpec(): ?string;

    /**
     * @return string|null
     */
    public function getSchema(): ?string;

    /**
     * @return string|null
     */
    public function getExtends(): ?string;

    /**
     * @return array|null
     */
    public function getConfig(): ?array;

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
     * @param string|null $spec
     * @return self
     */
    public function setSpec(?string $spec): self;

    /**
     * @param string|null $schema
     * @return self
     */
    public function setSchema(?string $schema): self;

    /**
     * @param string|null $extends
     * @return self
     */
    public function setExtends(?string $extends): self;

    /**
     * @param array|null $config
     * @return self
     */
    public function setConfig(?array $config): self;
}
