<?php

use Gabbanaesteban\Mastermind\Mastermind;
use Gabbanaesteban\Mastermind\Color;
use Gabbanaesteban\Mastermind\Hint;

it('creates a Mastermind instance with random code', function () {
    $mastermind = Mastermind::withRandomCode();

    expect($mastermind)->toBeInstanceOf(Mastermind::class);
    expect($mastermind->getCode())->toBeArray()->toHaveCount(4);
});

it('generates a valid code to instance Mastermind', function () {
    $randomCode = Mastermind::randomCode();
    $mastermind = new Mastermind($randomCode);

    expect($mastermind)->toBeInstanceOf(Mastermind::class);
    expect($mastermind->getCode())->ToBe($randomCode);
});

it('validates the given code has 4 colors in order to create an instance', function () {
    new Mastermind([
        Color::BLUE, Color::YELLOW, Color::PINK
    ]);
})->throws(\InvalidArgumentException::class, 'The code should have a length of 4');

it('validates the given code has only valid colors in order to create an instance', function () {
    new Mastermind([
        Color::BLUE, Color::YELLOW, Color::PINK, 'ASD'
    ]);
})->throws(\InvalidArgumentException::class);

it('returns the code used to instance Mastermind', function () {
    $code = [Color::BLUE, Color::YELLOW, Color::PINK, Color::GREEN];
    $mastermind = new Mastermind($code);

    expect($mastermind)->toBeInstanceOf(Mastermind::class);
    expect($mastermind->getCode())->toBe($code);
});

it('validates the given guess has 4 colors in order to get hints', function () {
    Mastermind::withRandomCode()->getHints([
        Color::BLUE, Color::YELLOW, Color::PINK
    ]);
})->throws(\InvalidArgumentException::class, 'The code should have a length of 4');

it('validates the given guess has only valid colors in order to get hints', function () {
    Mastermind::withRandomCode()->getHints([
        Color::BLUE, Color::YELLOW, 'ASD', Color::PINK
    ]);
})->throws(\InvalidArgumentException::class);

it('supports associative array as code', function () {
    $code = [
        'test' => Color::BLUE,
        'foo' => Color::YELLOW,
        'bar' => Color::GREEN,
        'meh' => Color::PINK
    ];

    $mastermind = new Mastermind($code);

    $hints = $mastermind->getHints(
        array_values($code)
    );

    expect($hints)->toBe(array_fill(0, 4, Hint::BLACK));
});

it('supports associative array as guess', function () {
    $guess = [
        'test' => Color::BLUE,
        'foo' => Color::YELLOW,
        'bar' => Color::GREEN,
        'meh' => Color::PINK
    ];

    $mastermind = new Mastermind(
        array_values($guess)
    );

    $hints = $mastermind->getHints($guess);

    expect($hints)->toBe(array_fill(0, 4, Hint::BLACK));
});

it('returns hints based on the given guess', function () {
    $code = [Color::YELLOW, Color::GREEN, Color::PINK, Color::YELLOW];

    $mastermind = new Mastermind($code);

    expect($mastermind->getHints(array_fill(0, 4, Color::BLUE)))->toBe([]);

    expect($mastermind->getHints([
        Color::BLUE,
        Color::BLUE,
        Color::GREEN,
        Color::GREEN
    ]))->toBe([Hint::WHITE]);

    expect($mastermind->getHints([
        Color::BLUE,
        Color::BLUE,
        Color::PINK,
        Color::PINK
    ]))->toBe([Hint::BLACK]);

    expect($mastermind->getHints([
        Color::BLUE,
        Color::BLUE,
        Color::YELLOW,
        Color::YELLOW
    ]))->toBe([Hint::WHITE, Hint::BLACK]);

    expect($mastermind->getHints([
        Color::GREEN,
        Color::YELLOW,
        Color::PINK,
        Color::YELLOW
    ]))->toBe([Hint::WHITE, Hint::WHITE, Hint::BLACK, Hint::BLACK]);

    expect($mastermind->getHints($code))->toBe(array_fill(0, 4, Hint::BLACK));
});
