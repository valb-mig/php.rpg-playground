<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Actions\Dice;

use RPGPlayground\Domain\ValueObjects\Dice;

final class RollDiceAction
{
    /**
     * Returns the result of rolling a dice with the given number of sides.
     * @param Dice $dice The dice to roll.
     * @return int The result of the roll.
     * @throws \Random\RandomException if the system entropy source fails.
     */
    public static function roll(Dice $dice): int
    {
        return random_int(Dice::MINIMUM_VALUE, $dice->sides);
    }
}
