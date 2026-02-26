<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Request\Validator;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\InputException;
use Spyrosoft\Ucp\Service\Builder\Ucp;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class UcpAgent implements ValidatorInterface
{
    private const HEADER_NAME = 'UCP-Agent';

    public function __construct(
        private readonly RequestInterface $request
    ) {
    }

    public function validate(array $params = []): void
    {
        $header = (string)$this->request->getHeader(self::HEADER_NAME);

        preg_match(
            '/version="(?P<version>[^"]+)"/',
            $header,
            $matches
        );

        $requestedVersion = $matches['version'] ?? null;

        if ($requestedVersion && strtotime($requestedVersion) > strtotime(Ucp::SCHEMA_VERSION)) {
            throw new InputException(__('Version %1 is not supported.', $requestedVersion));
        }
    }
}
