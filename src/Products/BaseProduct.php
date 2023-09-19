<?php

declare(strict_types=1);

namespace GildedRose\Products;

use GildedRose\Item;

readonly class BaseProduct implements ProductInterface
{
    public const MAX_QUALITY_LIMIT = 50;

    public const MIN_QUALITY_LIMIT = 0;

    public function __construct(
        public Item $item
    ) {
    }

    public function isExpiredDate(): bool
    {
        return $this->item->sellIn < 0;
    }

    public function updateItem(): void
    {
        $this->decreaseSellIn();

        if ($this->isExpiredDate()) {
            $this->decreaseQuality(2);
        } else {
            $this->decreaseQuality();
        }
    }

    protected function decreaseSellIn(int $sellIn = 1): void
    {
        $this->item->sellIn = $this->item->sellIn - $sellIn;
    }

    protected function increaseQuality(int $quality = 1): void
    {
        $this->item->quality = $this->item->quality + $quality;
        $this->item->quality = min($this->item->quality, self::MAX_QUALITY_LIMIT);
    }

    protected function decreaseQuality(int $quality = 1): void
    {
        $this->item->quality = $this->item->quality - $quality;
        $this->item->quality = max($this->item->quality, self::MIN_QUALITY_LIMIT);
    }
}
