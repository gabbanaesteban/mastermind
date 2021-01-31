<?php

use Gabbanaesteban\Mastermind\Mastermind;
use Gabbanaesteban\Mastermind\Color;
use Gabbanaesteban\Mastermind\Hint;

test('Example A', function () {
    $mastermind = new Mastermind([
        Color::PINK, Color::ORANGE, Color::BLUE, Color::GREEN
    ]);

    $hints = $mastermind->getHints([
        Color::ORANGE, Color::YELLOW, Color::BLUE, Color::PURPLE
    ]);

    expect($hints)->toMatchArray([Hint::WHITE, Hint::BLACK]);
});

test('Example B', function () {
    $mastermind = new Mastermind([
        Color::PINK, Color::BLUE, Color::GREEN, Color::PURPLE
    ]);

    $hints = $mastermind->getHints([
        Color::ORANGE, Color::YELLOW, Color::GREEN, Color::GREEN
    ]);

    expect($hints)->toMatchArray([Hint::BLACK]);
});

test('Example C', function () {
    $mastermind = new Mastermind([
        Color::YELLOW, Color::BLUE, Color::YELLOW, Color::PURPLE
    ]);

    $hints = $mastermind->getHints([
        Color::PINK, Color::YELLOW, Color::GREEN, Color::ORANGE
    ]);

    expect($hints)->toMatchArray([Hint::WHITE]);
});

test('Example D', function () {
    $mastermind = new Mastermind([
        Color::PINK, Color::BLUE, Color::PINK, Color::YELLOW
    ]);

    $hints = $mastermind->getHints([
        Color::GREEN, Color::PINK, Color::PINK, Color::ORANGE
    ]);

    expect($hints)->toMatchArray([Hint::WHITE, Hint::BLACK]);
});
