<?php

declare(strict_types=1);

namespace GildedRose\Products;

readonly class TicketProduct extends BaseProduct
{
    public function updateItem(): void
    {
        $this->decreaseSellIn();

        if ($this->isExpiredDate()) {
            $this->decreaseQuality($this->item->quality);
            return;
        }

        if ($this->item->sellIn < 5) {
            $this->increaseQuality(3);
            return;
        }
        if ($this->item->sellIn < 10) {
            $this->increaseQuality(2);
            return;
        }

        $this->increaseQuality();
    }
}
