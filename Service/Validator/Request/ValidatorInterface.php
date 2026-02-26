<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Service\Validator\Request;

use Magento\Framework\Exception\LocalizedException;

interface ValidatorInterface
{
    /**
     * @throws LocalizedException
     */
    public function validate(array $params = []): void;
}
