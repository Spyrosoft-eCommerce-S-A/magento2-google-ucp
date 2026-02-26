<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Model\Data\Checkout\LineItem;

use Spyrosoft\Ucp\Model\DataObject;
use Spyrosoft\Ucp\Api\Data\Checkout\LineItem\ItemInterface;

class Item extends DataObject implements ItemInterface
{
    public function getId(): string
    {
        return (string)$this->getData(self::ID);
    }

    public function getTitle(): string
    {
        return (string)$this->getData(self::TITLE);
    }

    public function getPrice(): int
    {
        return (int)$this->getData(self::PRICE);
    }

    public function getImageUrl(): ?string
    {
        return $this->getData(self::IMAGE_URL);
    }

    public function setId(string $id): ItemInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function setTitle(string $title): ItemInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    public function setPrice(int $price): ItemInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    public function setImageUrl(?string $imageUrl): ItemInterface
    {
        return $this->setData(self::IMAGE_URL, $imageUrl);
    }
}
