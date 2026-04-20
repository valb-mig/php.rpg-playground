<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Dice\RollDice;

use Eco\Result;
use RPGKernel\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGKernel\Application\UseCase\Dice\RollDice\RollDiceOutput;
use RPGKernel\Core\Handler\RPGSessionEventHandler;
use RPGKernel\Domain\Enums\Roll\RollAttribute;
use RPGKernel\Domain\Events\Dice\RollDiceEvent;

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

        if ($input->hasSession()) {
            RPGSessionEventHandler::dispatch(new RollDiceEvent(
                sessionId: $input->getSessionId(),
                dice: $input->dice,
                modifiers: $input->modifiers,
                multiplier: $input->multiplier,
                attribute: $input->attribute,
                rollValue: $total,
            ));
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
            $rolls[] = $input->dice->roll();
        }

        if ($input->attribute !== null) {
            $rolls[] = $input->dice->roll();
        }

        return $rolls;
    }
}
