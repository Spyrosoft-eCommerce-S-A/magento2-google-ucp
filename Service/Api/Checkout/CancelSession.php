<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api\Checkout;

use Exception;
use Magento\Framework\Exception\InputException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Builder\Checkout as CheckoutBuilder;

class CancelSession
{
    public function __construct(
        private readonly CheckoutBuilder $checkoutBuilder,
        private readonly MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        private readonly CartRepositoryInterface $cartRepository
    ) {
    }

    public function execute(
        string $maskedQuoteId
    ): CheckoutInterface {
        try {
            $quoteId = $this->maskedQuoteIdToQuoteId->execute($maskedQuoteId);
            $cart = $this->cartRepository->getActive($quoteId);
        } catch (Exception) {
            throw new InputException(__('The checkout session with the provided ID does not exist.'));
        }

        $cart->setIsActive(false);
        $this->cartRepository->save($cart);

        return $this->checkoutBuilder->build(
            $maskedQuoteId,
            $cart
        );
    }
}
