<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface PaymentInterface
{
    public const INSTRUMENTS = 'instruments';

    /**
     * @return array
     */
    public function getInstruments(): array;

    /**
     * @param array $instruments
     * @return self
     */
    public function setInstruments(array $instruments): self;
}
