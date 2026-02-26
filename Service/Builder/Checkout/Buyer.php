<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\BuyerInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class Buyer implements BuilderInterface
{
    public function __construct(
        private readonly BuyerInterfaceFactory $buyerFactory
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        /** @var Quote $quote */
        $billingAddress = $quote->getBillingAddress();

        if ($billingAddress->getFirstname() || $billingAddress->getLastname() || $billingAddress->getEmail()) {
            /** @var BuyerInterface $buyer */
            $buyer = $this->buyerFactory->create();
            $buyer->setFirstName($billingAddress->getFirstname() ?: '');
            $buyer->setLastName($billingAddress->getLastname() ?: '');
            $buyer->setFullName(
                implode(
                    ' ',
                    array_filter(
                        [
                            $billingAddress->getFirstname(),
                            $billingAddress->getLastname()
                        ]
                    )
                )
            );
            $buyer->setEmail($billingAddress->getEmail() ?: '');
            $buyer->setPhoneNumber($billingAddress->getTelephone() ?: '');

            $checkout->setBuyer($buyer);
        }
    }
}
