<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Request\Validator;

use Magento\Framework\Exception\InputException;
use Spyrosoft\Ucp\Service\Config;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class ModuleStatus implements ValidatorInterface
{
    public function __construct(
        private readonly Config $config
    ) {
    }

    public function validate(array $params = []): void
    {
        if (!$this->config->isEnabled()) {
            throw new InputException(__('Universal Commerce Protocol is not available.'));
        }
    }
}
