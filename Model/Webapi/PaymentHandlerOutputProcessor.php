<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Webapi;

use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface;

class PaymentHandlerOutputProcessor
{
    public function execute(
        HandlerInterface $handler,
        array $result
    ): array {
        if (!empty($handler->getConfig())) {
            $result[HandlerInterface::CONFIG] = $handler->getConfig();
        }

        return $result;
    }
}
