<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface OrderConfirmationInterface
{
    public const ID = 'id';
    public const PERMALINK_URL = 'permalink_url';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @return string
     */
    public function getPermalinkUrl(): string;

    /**
     * @param string $permalinkUrl
     * @return self
     */
    public function setPermalinkUrl(string $permalinkUrl): self;
}
