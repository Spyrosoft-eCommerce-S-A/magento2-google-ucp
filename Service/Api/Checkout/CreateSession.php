<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api\Checkout;

use Magento\Quote\Api\GuestCartManagementInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\FulfillmentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class CreateSession
{
    public function __construct(
        private readonly GuestCartManagementInterface $guestCartManagement,
        private readonly UpdateSession $updateSession
    ) {
    }

    /**
     * @param LineItemInterface[] $line_items
     */
    public function execute(
        array $line_items,
        string $currency,
        mixed $payment,
        ?BuyerInterface $buyer = null,
        ?FulfillmentInterface $fulfillment = null,
        ?string $selectedFulfillmentOption = null
    ): CheckoutInterface {
        $maskedQuoteId = $this->guestCartManagement->createEmptyCart();

        return $this->updateSession->execute(
            $maskedQuoteId,
            $line_items,
            $currency,
            $payment,
            $buyer,
            $fulfillment,
            $selectedFulfillmentOption
        );
    }
}
