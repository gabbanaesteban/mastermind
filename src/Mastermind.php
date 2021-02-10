<?php

namespace Gabbanaesteban\Mastermind;

class Mastermind
{
    public const CODE_LENGTH = 4;
    public const VALID_COLORS = [
        Color::PINK,
        Color::ORANGE,
        Color::YELLOW,
        Color::GREEN,
        Color::BLUE,
        Color::PURPLE,
    ];

    protected array $code;

    /**
     * @param string[] $code
     */
    public function __construct(array $code)
    {
        $code = \array_values($code);
        $this->validateCodeOrFail($code);
        $this->code = $code;
    }

    /**
     * @return string[]
     */
    public function getCode(): array
    {
        return $this->code;
    }

    /**
     * Creates a new Mastermind instace with a random code
     */
    public static function withRandomCode(): self
    {
        return new self(self::randomCode());
    }

    /**
     * Generate a random valid code
     *
     * @return string[]
     */
    public static function randomCode(): array
    {
        return \array_rand(
            array_flip(self::VALID_COLORS),
            self::CODE_LENGTH
        );
    }

    /**
     * Returns an array with hints for the code based on the given guess.
     * This logic is based on Advanced Mastermind Instrctions
     * https://www.boardgamecapital.com/game_rules/mastermind.pdf
     * Read it carefully as this is an "Extra-Challenging Edition"
     *
     * @param string[] $guess
     *
     * @return string[]
     */
    public function getHints(array $guess): array
    {
        $guess = \array_values($guess);
        $this->validateCodeOrFail($guess);

        if ($this->getCode() === $guess) {
            return array_fill(0, 4, Hint::BLACK);
        }

        $hints = [];

        foreach ($guess as $key => $color) {
            if ($color === $this->getCode()[$key]) {
                $hints[$key] = Hint::BLACK;
                continue;
            }

            $codeKey = \array_search($color, $this->getCode());

            if (false !== $codeKey && !isset($hints[$codeKey])) {
                $hints[$codeKey] = Hint::WHITE;
            }
        }

        // Optional, just to get ordered number keys
        return [...$hints];
    }

    /**
     * @param string[] $code
     *
     * @throws \InvalidArgumentException
     */
    protected function validateCodeOrFail(array $code): void
    {
        $this->validateLengthOrFail($code);
        $this->validateColorsOrFail($code);
    }

    /**
     * @param string[] $code
     *
     * @throws \InvalidArgumentException
     */
    protected function validateLengthOrFail(array $code): void
    {
        if (!$this->hasRightLength($code)) {
            throw new \InvalidArgumentException('The code should have a length of ' . self::CODE_LENGTH);
        }
    }

    /**
     * @param string[] $code
     *
     * @throws \InvalidArgumentException
     */
    protected function validateColorsOrFail(array $code): void
    {
        if (!$this->hasValidColors($code)) {
            $validColorsAsString = \implode(',', self::VALID_COLORS);
            throw new \InvalidArgumentException("The code should have valid colors: $validColorsAsString");
        }
    }

    /**
     * @param string[] $code
     */
    protected function hasRightLength(array $code): bool
    {
        return self::CODE_LENGTH === \count($code);
    }

    /**
     * @param string[] $code
     */
    protected function hasValidColors(array $code): bool
    {
        $validColors = \array_intersect($code, self::VALID_COLORS);

        return \count($validColors) === \count($code);
    }
}
