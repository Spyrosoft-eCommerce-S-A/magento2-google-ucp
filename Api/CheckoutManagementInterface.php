<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api;

use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

interface CheckoutManagementInterface
{
    /**
     * @param LineItemInterface[] $line_items
     * @param string $currency
     * @param PaymentInterface $payment
     * @param BuyerInterface|null $buyer
     * @param FulfillmentInterface|null $fulfillment
     * @param string|null $selectedFulfillmentOption
     *
     * @return CheckoutInterface
     */
    public function create(
        array $line_items,
        string $currency,
        PaymentInterface $payment,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null,
    ): CheckoutInterface;

    /**
     * @param string $checkoutId
     * @param string $id
     * @param LineItemInterface[]|null $line_items
     * @param string|null $currency
     * @param PaymentInterface|null $payment
     * @param BuyerInterface|null $buyer
     * @param FulfillmentInterface|null $fulfillment
     * @param string|null $selectedFulfillmentOption
     *
     * @return CheckoutInterface
     */
    public function update(
        string $checkoutId,
        string $id,
        ?array $line_items = null,
        ?string $currency = null,
        ?PaymentInterface $payment = null,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null,
    ): CheckoutInterface;

    /**
     * @param string $checkoutId
     *
     * @return CheckoutInterface
     */
    public function get(
        string $checkoutId
    ): CheckoutInterface;

    /**
     * @param string $checkoutId
     * @param InstrumentInterface $payment_data
     * @param mixed $risk_signals
     *
     * @return CheckoutInterface
     */
    public function complete(
        string $checkoutId,
        InstrumentInterface $payment_data,
        mixed $risk_signals = null
    ): CheckoutInterface;

    /**
     * @param string $checkoutId
     *
     * @return CheckoutInterface
     */
    public function cancel(
        string $checkoutId
    ): CheckoutInterface;
}
