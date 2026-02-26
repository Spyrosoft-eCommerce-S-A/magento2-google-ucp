<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Api\Checkout\Handler;

use Closure;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Cart\AddProductsToCart;
use Magento\Quote\Model\Cart\Data\AddProductsToCartOutput;
use Magento\Quote\Model\Cart\Data\CartItemFactory;
use Magento\Quote\Model\Cart\Data\Error;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteMutexInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItemInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterfaceFactory;

class LineItems
{
    public function __construct(
        private readonly QuoteMutexInterface $quoteMutex,
        private readonly AddProductsToCart $addProductsToCart,
        private readonly CartRepositoryInterface $quoteRepository,
        private readonly MessageInterfaceFactory $messageFactory
    ) {
    }

    /**
     * @param LineItemInterface[] $lineItems
     * @return MessageInterface[]
     */
    public function handle(string $maskedQuoteId, CartInterface $quote, array $lineItems): array
    {
        /** @var Quote $quote */
        if ($quote->hasItems()) {
            $quote->removeAllItems();
            $quote->collectTotals();
            $this->quoteRepository->save($quote);
        }

        $cartItems = [];
        foreach ($lineItems as $lineItem) {
            $cartItems[] = (new CartItemFactory())->create([
                'sku' => $lineItem->getItem()->getId(),
                'quantity' => $lineItem->getQuantity(),
            ]);
        }

        /** @var AddProductsToCartOutput $output */
        $output = $this->quoteMutex->execute(
            [$maskedQuoteId],
            Closure::fromCallable([$this, 'runAddToCart']),
            [$maskedQuoteId, $cartItems]
        );

        return $this->parseErrors($output->getErrors());
    }

    private function parseErrors(array $errors): array
    {
        $result = [];
        /** @var Error $error */
        foreach ($errors as $error) {
            /** @var MessageInterface $message */
            $message = $this->messageFactory->create();
            $message->setType(MessageInterface::TYPE_ERROR);
            $message->setCode('invalid');
            $message->setContent($error->getMessage());
            $message->setSeverity(MessageInterface::SEVERITY_RECOVERABLE);

            $result[] = $message;
        }
        return $result;
    }

    private function runAddToCart(
        string $maskedQuoteId,
        array $cartItems
    ): AddProductsToCartOutput {
        return $this->addProductsToCart->execute(
            $maskedQuoteId,
            $cartItems
        );
    }
}
