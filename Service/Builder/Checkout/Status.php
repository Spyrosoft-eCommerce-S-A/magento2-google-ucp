<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;

class Status implements BuilderInterface
{
    public const STATUS_INCOMPLETE = 'incomplete';
    public const STATUS_READY_FOR_COMPLETE = 'ready_for_complete';
    public const STATUS_REQUIRES_ESCALATION = 'requires_escalation';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_COMPLETED = 'completed';

    public function build(
        CartInterface $quote,
        CheckoutInterface $checkout,
        ?OrderInterface $order = null
    ): void
    {
        if ($order !== null) {
            $checkout->setStatus(self::STATUS_COMPLETED);

            return;
        }

        if (!$quote->getIsActive()) {
            $checkout->setStatus(self::STATUS_CANCELED);

            return;
        }

        $status = self::STATUS_READY_FOR_COMPLETE;

        if (empty($checkout->getMessages())) {
            $checkout->setStatus($status);

            return;
        }

        foreach ($checkout->getMessages() as $message) {
            if ($message->getSeverity() === MessageInterface::SEVERITY_REQUIRES_BUYER_INPUT ||
                $message->getSeverity() === MessageInterface::SEVERITY_REQUIRES_BUYER_REVIEW) {
                $status = self::STATUS_REQUIRES_ESCALATION;

                break;
            }

            if ($message->getSeverity() === MessageInterface::SEVERITY_RECOVERABLE) {
                $status = self::STATUS_INCOMPLETE;
            }
        }

        $checkout->setStatus($status);
    }
}
