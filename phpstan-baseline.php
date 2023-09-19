<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Ternary operator condition is always true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/fixtures/texttest_fixture.php',
];
$ignoreErrors[] = [
    'message' => '#^Method GildedRose\\\\Factories\\\\ProductFactory\\:\\:create\\(\\) should return GildedRose\\\\Products\\\\ProductInterface but returns object\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/src/Factories/ProductFactory.php',
];
$ignoreErrors[] = [
    'message' => '#^Method GildedRose\\\\Config\\\\Config\\:\\:get\\(\\) has no return type specified\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/src/config/Config.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
