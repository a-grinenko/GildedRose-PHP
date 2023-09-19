<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @throws \Exception
     */
    public function testItem(int $days, array $itemsData, array $results): void
    {
        $items = [];
        foreach ($itemsData as $itemData) {
            $items[] = new Item($itemData['name'], $itemData['sellIn'], $itemData['quality']);
        }

        if (empty($items)) {
            throw new \Exception('Products cannot be empty');
        }

        $gildedRose = new GildedRose($items);
        for ($i = 0; $i < $days; $i++) {
            $gildedRose->updateQuality();
        }

        foreach ($results as $key => $result) {
            $this->assertSame($result['sellIn'], $items[$key]->sellIn);
            $this->assertSame($result['quality'], $items[$key]->quality);
        }
    }

    public function dataProvider(): array
    {
        return [
            'Concert ticket Item' => [
                'days' => 6,
                'items' => [
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 15,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 10,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 5,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 10,
                        'quality' => 10,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => 9,
                        'quality' => 27,
                    ],
                    [
                        'sellIn' => 4,
                        'quality' => 50,
                    ],
                    [
                        'sellIn' => -1,
                        'quality' => 0,
                    ],
                    [
                        'sellIn' => 4,
                        'quality' => 23,
                    ],
                ],
            ],
            'Legendary Item' => [
                'days' => 2,
                'items' => [
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                ],
            ],
            'Base Item' => [
                'days' => 2,
                'items' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 10,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Elixir of the Mongoose',
                        'sellIn' => 5,
                        'quality' => 7,
                    ],
                    [
                        'name' => 'Conjured Mana Cake',
                        'sellIn' => 3,
                        'quality' => 6,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => 8,
                        'quality' => 18,
                    ],
                    [
                        'sellIn' => 3,
                        'quality' => 5,
                    ],
                    [
                        'sellIn' => 1,
                        'quality' => 4,
                    ],
                ],
            ],
            'Quality is downgraded twice (Base Item)' => [
                'days' => 3,
                'items' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 1,
                        'quality' => 11,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => -2,
                        'quality' => 6,
                    ],
                ],
            ],
            'Limit 0 (Base Item)' => [
                'days' => 3,
                'items' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 15,
                        'quality' => 1,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => 12,
                        'quality' => 0,
                    ],
                ],
            ],
            'Rare Item (Aged Brie)' => [
                'days' => 3,
                'items' => [
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => 2,
                        'quality' => 0,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => -1,
                        'quality' => 4,
                    ],
                ],
            ],
            'Limit 50 (Rare Item)' => [
                'days' => 5,
                'items' => [
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => -1,
                        'quality' => 49,
                    ],
                ],
                'results' => [
                    [
                        'sellIn' => -6,
                        'quality' => 50,
                    ],
                ],
            ],
        ];
    }
}
