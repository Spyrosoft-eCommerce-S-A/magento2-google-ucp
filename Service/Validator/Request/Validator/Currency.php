<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Request\Validator;

use Magento\Framework\Exception\InputException;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class Currency implements ValidatorInterface
{
    public function __construct(
        private readonly StoreManagerInterface $storeManager
    ) {
    }

    public function validate(array $params = []): void
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        $currency = $params['currency'] ?? '';

        if ($currency && !in_array($currency, $store->getAvailableCurrencyCodes(), true)) {
            throw new InputException(__('Currency is not supported'));
        }
    }
}
