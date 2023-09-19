<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Factories\ProductFactory;

final readonly class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        try {
            foreach ($this->items as $item) {
                $product = ProductFactory::create($item);
                $product->updateItem();
            }
        } catch (\Exception $e) {
            // log errors
        }
    }
}
