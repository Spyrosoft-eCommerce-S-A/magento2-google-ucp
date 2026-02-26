<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ProductId implements OptionSourceInterface
{
    public const VALUE_SKU = 'sku';
    public const VALUE_ID = 'entity_id';

    public function toOptionArray(): array
    {
        return [
            ['value' => self::VALUE_SKU, 'label' => __('SKU')],
            ['value' => self::VALUE_ID, 'label' => __('Entity ID')],
        ];
    }
}
