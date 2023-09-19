<?php

declare(strict_types=1);

namespace GildedRose\Factories;

use GildedRose\Config\ProductsConfig;
use GildedRose\Item;
use GildedRose\Products\ProductInterface;
use ProductNotFoundException;
use ReflectionClass;

final readonly class ProductFactory
{
    /**
     * @throws ProductNotFoundException
     * @throws \ReflectionException
     */
    public static function create(Item $item): ProductInterface
    {
        $product = ProductsConfig::get($item->name);

        if ($product === null) {
            throw new ProductNotFoundException('Product was not found');
        }

        return (new ReflectionClass($product))->newInstanceArgs([$item]);
    }
}
