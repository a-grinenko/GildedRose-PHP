<?php

declare(strict_types=1);

namespace GildedRose\Products;

readonly class RareProduct extends BaseProduct
{
    public function updateItem(): void
    {
        $this->decreaseSellIn();

        if ($this->isExpiredDate()) {
            $this->increaseQuality(2);
        } else {
            $this->increaseQuality();
        }
    }
}
