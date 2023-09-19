<?php

declare(strict_types=1);

namespace GildedRose\Config;

use GildedRose\Products\BaseProduct;
use GildedRose\Products\LegendaryProduct;
use GildedRose\Products\RareProduct;
use GildedRose\Products\TicketProduct;

final class ProductsConfig extends Config
{
    protected static array $data = [
        '+5 Dexterity Vest' => BaseProduct::class,
        'Elixir of the Mongoose' => BaseProduct::class,
        'Conjured Mana Cake' => BaseProduct::class,
        'Aged Brie' => RareProduct::class,
        'Sulfuras, Hand of Ragnaros' => LegendaryProduct::class,
        'Backstage passes to a TAFKAL80ETC concert' => TicketProduct::class,
    ];
}
