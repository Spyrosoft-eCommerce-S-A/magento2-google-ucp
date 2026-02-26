<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Spyrosoft\Ucp\Api\Data\Ucp\CapabilityInterface;
use Spyrosoft\Ucp\Api\Data\Ucp\CapabilityInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\UcpInterface;
use Spyrosoft\Ucp\Api\Data\UcpInterfaceFactory;

class Ucp
{
    public const string SCHEMA_VERSION = '2026-01-11';

    public function __construct(
        private readonly UcpInterfaceFactory $ucpFactory,
        private readonly CapabilityInterfaceFactory $capabilityFactory,
        private readonly StoreManagerInterface $storeManager,
        private readonly array $capabilities = [],
        private readonly array $services = []
    ) {
    }

    public function build(): UcpInterface
    {
        /** @var UcpInterface $ucp */
        $ucp = $this->ucpFactory->create();

        $ucp->setVersion(self::SCHEMA_VERSION);

        $services = $this->services;
        foreach ($services as $key => $service) {
            if (!isset($service['version'])) {
                $services[$key]['version'] = self::SCHEMA_VERSION;
            }

            if (isset($service['rest']['endpoint'])) {
                $services[$key]['rest']['endpoint'] = $this->getBaseUrl() . $service['rest']['endpoint'];
            }
        }
        $ucp->setServices($services);

        $capabilities = [];

        foreach ($this->capabilities as $name => $capabilityConfig) {
            /** @var CapabilityInterface $capability */
            $capability = $this->capabilityFactory->create();

            $capability->setName($name);
            $capability->setVersion($capabilityConfig['version'] ?? self::SCHEMA_VERSION);

            if (isset($capabilityConfig['spec'])) {
                $capability->setSpec($capabilityConfig['spec']);
            }

            if (isset($capabilityConfig['schema'])) {
                $capability->setSchema($capabilityConfig['schema']);
            }

            if (isset($capabilityConfig['extends'])) {
                $capability->setExtends($capabilityConfig['extends']);
            }

            if (isset($capabilityConfig['config'])) {
                $capability->setConfig($capabilityConfig['config']);
            }

            $capabilities[] = $capability;
        }

        $ucp->setCapabilities($capabilities);

        return $ucp;
    }

    private function getBaseUrl(): string
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();

        return (string)$store->getBaseUrl(UrlInterface::URL_TYPE_WEB);
    }
}
