<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Request;

class CompositeValidator implements ValidatorInterface
{
    /**
     * @param ValidatorInterface[] $validators
     */
    public function __construct(
        private readonly array $validators = []
    ) {
    }

    public function validate(array $params = []): void
    {
        foreach ($this->validators as $validator) {
            $validator->validate($params);
        }
    }
}
