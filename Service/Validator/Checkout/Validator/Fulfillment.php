<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Validator\Checkout\Validator;

use Magento\Quote\Api\Data\CartInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\MessageInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\CheckoutInterface;
use Spyrosoft\Ucp\Service\Validator\Checkout\ValidatorInterface;

class Fulfillment implements ValidatorInterface
{
    private const REQUIRED_FIELDS = [
        'firstname',
        'lastname',
        'street',
        'city',
        'postcode',
        'country_id',
        'telephone'
    ];

    public function __construct(
        private readonly MessageInterfaceFactory $messageFactory
    ) {
    }

    public function validate(CartInterface $quote, CheckoutInterface $checkout): array
    {
        if ($quote->getIsVirtual()) {
            return [];
        }

        $result = [];

        $shippingAddress = $quote->getShippingAddress();

        if (!$shippingAddress->getShippingMethod()) {
            /** @var MessageInterface $message */
            $message = $this->messageFactory->create();
            $message->setType(MessageInterface::TYPE_ERROR);
            $message->setCode('missing');
            $message->setPath('$.selected_fulfillment_option');
            $message->setContent('Please select a fulfillment option');
            $message->setSeverity(MessageInterface::SEVERITY_RECOVERABLE);

            $result[] = $message;
        }

        foreach (self::REQUIRED_FIELDS as $field) {
            if (!$shippingAddress->getData($field)) {
                /** @var MessageInterface $message */
                $message = $this->messageFactory->create();
                $message->setType(MessageInterface::TYPE_ERROR);
                $message->setCode('fulfillment_address_' . $field . '_missing');
                $message->setContent(
                    sprintf(
                        'Field %s is required in shipping address.',
                        $field
                    )
                );
                $message->setSeverity(MessageInterface::SEVERITY_RECOVERABLE);

                $result[] = $message;
            }
        }

        return $result;
    }
}
