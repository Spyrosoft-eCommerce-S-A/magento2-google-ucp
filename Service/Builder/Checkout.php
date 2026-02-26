<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterfaceFactory;
use Spyrosoft\Ucp\Service\Builder\Checkout\BuilderInterface;
use Spyrosoft\Ucp\Service\Builder\Checkout\Status;
use Spyrosoft\Ucp\Service\Validator\Checkout\ValidatorInterface;

class Checkout
{
    public function __construct(
        private readonly CheckoutInterfaceFactory $checkoutFactory,
        private readonly Ucp $ucpBuilder,
        private readonly Status $statusBuilder,
        private readonly BuilderInterface $compositeBuilder,
        private readonly ValidatorInterface $checkoutValidator
    ) {
    }

    /**
     * @param string $maskedQuoteId
     * @param CartInterface $quote
     * @param MessageInterface[] $errorMessages
     * @return CheckoutInterface
     */
    public function build(
        string $maskedQuoteId,
        CartInterface $quote,
        array $errorMessages = [],
        ?OrderInterface $order = null
    ): CheckoutInterface
    {
        /** @var Quote $quote */
        /** @var CheckoutInterface $checkout */
        $checkout = $this->checkoutFactory->create();
        $checkout->setUcp($this->ucpBuilder->build());
        $checkout->setId($maskedQuoteId);
        $checkout->setCurrency((string)$quote->getQuoteCurrencyCode());
        $checkout->setLinks([]);

        $this->compositeBuilder->build($quote, $checkout, $order);

        $checkout->setMessages(
            [
                ...$errorMessages,
                ...$this->checkoutValidator->validate(
                    $quote,
                    $checkout
                )
            ]
        );

        // Status builder may not be part of composite builder as it depends on validation results
        $this->statusBuilder->build(
            $quote,
            $checkout
        );

        return $checkout;
    }
}
