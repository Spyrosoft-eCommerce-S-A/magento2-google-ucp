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
    public function getHandlers(): array
    {
        return (array)$this->getData(self::HANDLERS);
    }

    public function getSelectedInstrumentId(): ?string
    {
        return $this->getData(self::SELECTED_INSTRUMENT_ID);
    }

    public function getInstruments(): array
    {
        return (array)$this->getData(self::INSTRUMENTS);
    }

    public function setHandlers(array $handlers): PaymentInterface
    {
        return $this->setData(self::HANDLERS, $handlers);
    }

    public function setSelectedInstrumentId(?string $selectedInstrumentId): PaymentInterface
    {
        return $this->setData(self::SELECTED_INSTRUMENT_ID, $selectedInstrumentId);
    }

    public function setInstruments(array $instruments): PaymentInterface
    {
        return $this->setData(self::INSTRUMENTS, $instruments);
    }
}

