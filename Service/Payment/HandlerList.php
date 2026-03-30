<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Payment;

use Magento\Quote\Api\Data\CartInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;

class HandlerList
{
    /**
     * @param HandlerProviderInterface[] $providers
     */
    public function __construct(
        private readonly array $providers = []
    ) {
    }

    /**
     * @return HandlerInterface[]
     */
    public function execute(): array
    {
        $result = [];

        foreach ($this->providers as $provider) {
            $handler = $provider->getHandler();

            if ($handler instanceof HandlerInterface) {
                $result[$handler->getId()] = $handler;
            }
        }

        return $result;
    }

    public function handle(
        string $handlerId,
        CartInterface $quote,
        InstrumentInterface $paymentData
    ): void
    {
        if (isset($this->providers[$handlerId])) {
            $this->providers[$handlerId]->handle($quote, $paymentData);
        }
    }
}
