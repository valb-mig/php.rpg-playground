<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Actions\Dice;

use RPGPlayground\Domain\ValueObjects\App\Dice;

final class RollDiceAction
{
    /**
     * Returns the result of rolling a dice with the given number of sides.
     * @param Dice $dice The dice to roll.
     * @return int The result of the roll.
     */
    public static function roll(Dice $dice): int
    {
        return (int) ceil(rand(Dice::MINIMUM_VALUE, $dice->sides));
    }
}
