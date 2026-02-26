<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api;

use Spyrosoft\Ucp\Api\CheckoutManagementInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Api\Checkout\CancelSession;
use Spyrosoft\Ucp\Service\Api\Checkout\CompleteSession;
use Spyrosoft\Ucp\Service\Api\Checkout\CreateSession;
use Spyrosoft\Ucp\Service\Api\Checkout\GetSession;
use Spyrosoft\Ucp\Service\Api\Checkout\UpdateSession;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class CheckoutManagement implements CheckoutManagementInterface
{
    public function __construct(
        private readonly CreateSession $createSessionService,
        private readonly UpdateSession $updateSessionService,
        private readonly GetSession $getSessionService,
        private readonly CompleteSession $completeSession,
        private readonly CancelSession $cancelSession,
        private readonly ValidatorInterface $requestValidator
    ) {
    }

    public function create(
        array $line_items,
        string $currency,
        mixed $payment,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null,
    ): CheckoutInterface
    {
        $this->requestValidator->validate([
            'currency' => $currency,
        ]);

        return $this->createSessionService->execute(
            $line_items,
            $currency,
            $payment,
            $buyer,
            $fulfillment,
            $selectedFulfillmentOption
        );
    }

    public function update(
        string $checkoutId,
        string $id,
        ?array $line_items = null,
        ?string $currency = null,
        mixed $payment = null,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null,
    ): CheckoutInterface
    {
        $this->requestValidator->validate([
            'currency' => $currency,
        ]);

        return $this->updateSessionService->execute(
            $checkoutId,
            $line_items,
            $currency,
            $payment,
            $buyer,
            $fulfillment,
            $selectedFulfillmentOption
        );
    }

    public function get(string $checkoutId): CheckoutInterface
    {
        $this->requestValidator->validate();

        return $this->getSessionService->execute($checkoutId);
    }

    public function complete(
        string $checkoutId,
        InstrumentInterface $payment_data,
        mixed $risk_signals = null
    ): CheckoutInterface
    {
        $this->requestValidator->validate();

        return $this->completeSession->execute(
            $checkoutId,
            $payment_data,
            $risk_signals
        );
    }

    public function cancel(string $checkoutId): CheckoutInterface
    {
        $this->requestValidator->validate();

        return $this->cancelSession->execute($checkoutId);
    }
}
