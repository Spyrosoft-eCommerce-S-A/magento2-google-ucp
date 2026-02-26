<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface PaymentInterface
{
    public const HANDLERS = 'handlers';
    public const SELECTED_INSTRUMENT_ID = 'selected_instrument_id';
    public const INSTRUMENTS = 'instruments';

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface[]
     */
    public function getHandlers(): array;

    /**
     * @return string|null
     */
    public function getSelectedInstrumentId(): ?string;

    /**
     * @return array
     */
    public function getInstruments(): array;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface[] $handlers
     * @return self
     */
    public function setHandlers(array $handlers): self;

    /**
     * @param string|null $selectedInstrumentId
     * @return self
     */
    public function setSelectedInstrumentId(?string $selectedInstrumentId): self;

    /**
     * @param array $instruments
     * @return self
     */
    public function setInstruments(array $instruments): self;
}
