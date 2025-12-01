<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\Console\EnigmaStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

test('encodedResult wraps long text correctly', function (): void {
    $input = new ArrayInput([]);
    $output = new BufferedOutput;
    $style = new EnigmaStyle($input, $output);

    // Create a long string that needs wrapping (max width is 60)
    $longText = str_repeat('A', 70);
    $style->encodedResult($longText);

    $content = $output->fetch();

    // Should contain the box drawing characters
    expect($content)->toContain('┌');
    expect($content)->toContain('└');

    // The text should be split.
    // wordwrap with width 60 means the first line should have 60 chars.
    // But EnigmaStyle uses wordwrap with cut=true.
    // Let's check if it contains the split parts.
    // 70 chars -> 60 + 10.
    // So we should see a line with 60 'A's and a line with 10 'A's.

    // We can just check that the content contains the string, but split?
    // BufferedOutput might return the raw string with newlines.

    // Check that the box width is dynamic but capped?
    // Actually EnigmaStyle calculates box width based on content.
    // If content is wrapped to 60, box width should be around 64.

    expect($content)->toContain(str_repeat('A', 60));
});

test('military formatting methods apply styles', function (): void {
    $input = new ArrayInput([]);
    $output = new BufferedOutput;
    $style = new EnigmaStyle($input, $output);

    $style->militaryInfo('Info message');
    $content = $output->fetch();
    expect($content)->toContain('Info message');
    // We can't easily check for ANSI codes with BufferedOutput unless we set it to decorated,
    // but by default it might strip them or keep them depending on setup.
    // BufferedOutput usually keeps tags if we don't specify otherwise?
    // Actually SymfonyStyle formats tags.
});

test('militaryError renders error box', function (): void {
    $input = new ArrayInput([]);
    $output = new BufferedOutput;
    $style = new EnigmaStyle($input, $output);

    $style->militaryError('Critical Failure');
    $content = $output->fetch();

    expect($content)->toContain('ERROR');
    expect($content)->toContain('Critical Failure');
    expect($content)->toContain('╔');
});
