<?php

declare(strict_types=1);

test('example simple', function (): void {
    $r = true;

    try {
        ob_start();
        include __DIR__ . '/../../ExampleSimple.php';
        ob_end_clean();
    } catch (Exception $e) {
        $r = false;

        throw $e;
    }

    self::assertTrue($r);
});

test('example html', function (): void {
    $r = true;

    try {
        ob_start();
        include __DIR__ . '/../../ExampleHtml.php';
        ob_end_clean();
    } catch (Exception $e) {
        $r = false;

        throw $e;
    }

    self::assertTrue($r);
});
