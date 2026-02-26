<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */

namespace Spyrosoft\Ucp\Api\Data\Checkout\LineItem;

interface ItemInterface
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const PRICE = 'price';
    public const IMAGE_URL = 'image_url';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return int
     */
    public function getPrice(): int;

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string;

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self;

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self;

    /**
     * @param int $price
     * @return self
     */
    public function setPrice(int $price): self;

    /**
     * @param string|null $imageUrl
     * @return self
     */
    public function setImageUrl(?string $imageUrl): self;
}
