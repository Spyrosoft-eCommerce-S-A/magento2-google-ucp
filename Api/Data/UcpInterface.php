<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data;

interface UcpInterface
{
    public const VERSION = 'version';
    public const SERVICES = 'services';
    public const CAPABILITIES = 'capabilities';
    public const PAYMENT_HANDLERS = 'payment_handlers';

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return array
     */
    public function getServices(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Ucp\CapabilityInterface[]
     */
    public function getCapabilities(): array;

    /**
     * @return \Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface[]
     */
    public function getPaymentHandlers(): array;

    /**
     * @param string $version
     * @return self
     */
    public function setVersion(string $version): self;

    /**
     * @param array $services
     * @return self
     */
    public function setServices(array $services): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Ucp\CapabilityInterface[] $capabilities
     * @return self
     */
    public function setCapabilities(array $capabilities): self;

    /**
     * @param \Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface[] $paymentHandlers
     * @return self
     */
    public function setPaymentHandlers(array $paymentHandlers): self;
}
