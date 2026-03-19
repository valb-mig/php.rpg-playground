<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use Eco\Result;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceOutput;
use RPGPlayground\Domain\Actions\Dice\RollDiceAction;

final class RollDiceUseCase
{
    /**
     * @param  RollDiceInput $input
     * @return Result<RollDiceOutput>
     * @throws \Random\RandomException if the system entropy source fails.
     * @throws \LogicException if an invalid symbol somehow bypasses RollModifier::fromString.
     */
    public static function handle(RollDiceInput $input): Result
    {
        $total = 0;

        for ($i = 0; $i < $input->multiplier; $i++) {
            $total += RollDiceAction::roll($input->dice);
        }

        foreach ($input->modifiers as $modifier) {
            $total = $modifier->apply($total);
        }

        return Result::ok(new RollDiceOutput($total));
    }
}
