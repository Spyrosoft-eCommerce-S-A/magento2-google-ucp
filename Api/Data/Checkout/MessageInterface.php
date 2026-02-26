<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout;

interface MessageInterface
{
    public const TYPE = 'type';
    public const CODE = 'code';
    public const PATH = 'path';
    public const CONTENT_TYPE = 'content_type';
    public const CONTENT = 'content';
    public const SEVERITY = 'severity';

    public const TYPE_ERROR = 'error';
    public const TYPE_WARNING = 'warning';
    public const TYPE_INFO = 'info';

    public const CONTENT_TYPE_PLAIN = 'plain';
    public const CONTENT_TYPE_MARKDOWN = 'markdown';

    public const ERROR_CODE_MISSING = 'missing';
    public const ERROR_CODE_INVALID = 'invalid';
    public const ERROR_CODE_OUT_OF_STOCK = 'out_of_stock';
    public const ERROR_CODE_PAYMENT_DECLINED = 'payment_declined';
    public const ERROR_CODE_REQUIRES_SIGN_IN = 'requires_sign_in';
    public const ERROR_CODE_REQUIRES_3DS = 'requires_3ds';
    public const ERROR_CODE_REQUIRES_IDENTITY_LINKING = 'requires_identity_linking';

    public const SEVERITY_RECOVERABLE = 'recoverable';
    public const SEVERITY_REQUIRES_BUYER_INPUT = 'requires_buyer_input';
    public const SEVERITY_REQUIRES_BUYER_REVIEW = 'requires_buyer_review';

    /**
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * @return string|null
     */
    public function getPath(): ?string;

    /**
     * @return string|null
     */
    public function getContentType(): ?string;

    /**
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * @return string|null
     */
    public function getSeverity(): ?string;

    /**
     * @param string|null $type
     * @return self
     */
    public function setType(?string $type): self;

    /**
     * @param string|null $code
     * @return self
     */
    public function setCode(?string $code): self;

    /**
     * @param string|null $path
     * @return self
     */
    public function setPath(?string $path): self;

    /**
     * @param string|null $contentType
     * @return self
     */
    public function setContentType(?string $contentType): self;

    /**
     * @param string|null $content
     * @return self
     */
    public function setContent(?string $content): self;

    /**
     * @param string|null $severity
     * @return self
     */
    public function setSeverity(?string $severity): self;
}
