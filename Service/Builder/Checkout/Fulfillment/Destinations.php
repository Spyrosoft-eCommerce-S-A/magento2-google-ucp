<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Builder\Checkout\Fulfillment;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\Quote;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\ShippingDestinationInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Fulfillment\ShippingDestinationInterfaceFactory;

class Destinations
{
    public function __construct(
        private readonly ShippingDestinationInterfaceFactory $shippingDestinationFactory
    ) {
    }

    public function build(CartInterface $quote): array
    {
        /** @var Quote $quote */
        $result = [];

        $shippingAddress = $quote->getShippingAddress();

        if (!$shippingAddress->getFirstname()) {
            return $result;
        }

        /** @var ShippingDestinationInterface $shippingDestination */
        $shippingDestination = $this->shippingDestinationFactory->create();

        $shippingDestination->setId((string)$shippingAddress->getId());
        $shippingDestination->setFirstName($shippingAddress->getFirstname());
        $shippingDestination->setLastName($shippingAddress->getLastname());
        $shippingDestination->setPostalCode($shippingAddress->getPostcode());
        $shippingDestination->setAddressCountry($shippingAddress->getCountryId());
        $shippingDestination->setAddressRegion($shippingAddress->getRegion());
        $shippingDestination->setAddressLocality($shippingAddress->getCity());
        $shippingDestination->setStreetAddress($shippingAddress->getStreetFull());
        $shippingDestination->setPhoneNumber($shippingAddress->getTelephone());

        return [$shippingDestination];
    }
}
