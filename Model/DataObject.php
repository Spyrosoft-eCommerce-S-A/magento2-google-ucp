<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model;

class DataObject extends \Magento\Framework\DataObject
{
    public function toArray(array $keys = [])
    {
        if (empty($keys)) {
            $result = [];

            foreach ($this->_data as $key => $value) {
                if (is_array($value)) {
                    $resultArray = [];

                    foreach ($value as $valueKey => $valueItem) {
                        if (is_object($valueItem) && method_exists($valueItem, 'toArray')) {
                            $resultArray[$valueKey] = $valueItem->toArray();
                        } else {
                            $resultArray[$valueKey] = $valueItem;
                        }
                    }

                    $result[$key] = $resultArray;
                } else {
                    $result[$key] = $value;
                }
            }

            return $result;
        }

        return parent::toArray($keys);
    }
}
