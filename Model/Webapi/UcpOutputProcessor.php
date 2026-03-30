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
            $result[UcpInterface::SERVICES] = $ucp->getServices();
        }

        if (!empty($ucp->getCapabilities())) {
            $result[UcpInterface::CAPABILITIES] = [];

            foreach ($ucp->getCapabilities() as $key => $data) {
                $result[UcpInterface::CAPABILITIES][$key] = [
                    $data->getData()
                ];
            }
        }

        if (!empty($ucp->getPaymentHandlers())) {
            $result[UcpInterface::PAYMENT_HANDLERS] = [];

            foreach ($ucp->getPaymentHandlers() as $key => $data) {
                $result[UcpInterface::PAYMENT_HANDLERS][$key] = [
                    $data->getData()
                ];
            }
        }

        return $result;
    }
}
