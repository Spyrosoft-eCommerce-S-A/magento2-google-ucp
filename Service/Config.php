<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Spyrosoft\Ucp\Model\Config\Source\ProductId;

class Config
{
    private const XML_PATH_IS_ENABLED = 'ucp/general/is_enabled';
    private const XML_PATH_PRODUCT_ID = 'ucp/catalog/product_id';
    private const XML_PATH_DEFAULT_COUNTRY = 'general/country/default';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_IS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getProductIdentifier(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_ID,
            ScopeInterface::SCOPE_STORE
        ) ?: ProductId::VALUE_SKU;
    }

    public function getDefaultCountry(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_DEFAULT_COUNTRY,
            ScopeInterface::SCOPE_STORE
        );
    }
}
