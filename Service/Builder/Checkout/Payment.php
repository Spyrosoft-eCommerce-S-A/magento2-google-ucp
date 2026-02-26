<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Checkout\Api\PaymentInformationManagementInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Payment\HandlerList;

class Payment implements BuilderInterface
{
    public function __construct(
        private readonly PaymentInterfaceFactory $paymentFactory,
        private readonly HandlerList $handlerList,
        private readonly PaymentInformationManagementInterface $informationManagement
    ) {
    }

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        /** @var PaymentInterface $payment */
        $payment = $this->paymentFactory->create();

        $availableMethods = $this->getAvailablePaymentMethods((int)$quote->getId());
        $handlers = [];

        foreach ($this->handlerList->execute() as $handler) {
            if (!in_array($handler->getId(), $availableMethods, true)) {
                continue;
            }

            $handlers[] = $handler;
        }

        $payment->setHandlers($handlers);

        $checkout->setPayment($payment);
    }

    /**
     * @return string[]
     */
    private function getAvailablePaymentMethods(int $quoteId): array
    {
        $result = [];
        $paymentInformation = $this->informationManagement->getPaymentInformation($quoteId);

        foreach ($paymentInformation->getPaymentMethods() as $paymentMethod) {
            $result[] = $paymentMethod->getCode();
        }

        return $result;
    }
}
