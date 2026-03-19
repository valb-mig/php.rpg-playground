<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use Eco\Result;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceOutput;
use RPGPlayground\Domain\Actions\Dice\RollDiceAction;
use RPGPlayground\Domain\Enums\Roll\RollAttribute;

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
        $rolls = self::roll($input);

        $total = $input->attribute !== null
            ? match ($input->attribute) {
                RollAttribute::Advantage => max($rolls),
                RollAttribute::Disadvantage => min($rolls),
            }
            : array_sum($rolls);

        foreach ($input->modifiers as $modifier) {
            $total = $modifier->apply($total);
        }

        return Result::ok(new RollDiceOutput($total));
    }

    /**
     * @param RollDiceInput $input
     * @return array<int>
     * @throws \Random\RandomException if the system entropy source fails.
     */
    private static function roll(RollDiceInput $input): array
    {
        $rolls = [];

        for ($i = 0; $i < $input->multiplier; $i++) {
            $rolls[] = RollDiceAction::roll($input->dice);
        }

        if ($input->attribute !== null) {
            $rolls[] = RollDiceAction::roll($input->dice);
        }

        return $rolls;
    }
}
