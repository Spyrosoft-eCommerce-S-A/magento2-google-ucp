<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\PaymentInterface;

class Payment extends DataObject implements PaymentInterface
{
    public function getInstruments(): array
    {
        return (array)$this->getData(self::INSTRUMENTS);
    }

    public function setInstruments(array $instruments): PaymentInterface
    {
        return $this->setData(self::INSTRUMENTS, $instruments);
    }
}

