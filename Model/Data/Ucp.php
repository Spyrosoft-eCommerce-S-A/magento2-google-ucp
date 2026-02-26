<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\UcpInterface;

class Ucp extends DataObject implements UcpInterface
{
    public function getVersion(): string
    {
        return (string)$this->getData(self::VERSION);
    }

    public function getServices(): array
    {
        $result = $this->getData(self::SERVICES);

        if (!$result || !is_array($result)) {
            return [];
        }

        return $result;
    }

    public function getCapabilities(): array
    {
        $result = $this->getData(self::CAPABILITIES);

        if (!$result || !is_array($result)) {
            return [];
        }

        return $result;
    }

    public function setVersion(string $version): UcpInterface
    {
        return $this->setData(self::VERSION, $version);
    }

    public function setServices(array $services): UcpInterface
    {
        return $this->setData(self::SERVICES, $services);
    }

    public function setCapabilities(array $capabilities): UcpInterface
    {
        return $this->setData(self::CAPABILITIES, $capabilities);
    }
}
