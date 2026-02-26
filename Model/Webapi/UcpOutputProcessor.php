<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Webapi;

use Spyrosoft\Ucp\Api\Data\UcpInterface;

class UcpOutputProcessor
{
    public function execute(
        UcpInterface $ucp,
        array $result
    ): array {
        if (!empty($ucp->getServices())) {
            $result['services'] = $ucp->getServices();
        }

        return $result;
    }
}
