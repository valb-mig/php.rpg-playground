<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use Psl\Async;
use RPGPlayground\Domain\Actions\Dice\RollDiceAction;
use RPGPlayground\Domain\ValueObjects\Utils\Result;

final class RollDiceUseCase
{
    /**
     * @return Result<RollDiceUseCaseOutput|null>
     */
    public function run(RollDiceUseCaseInput $input): Result
    {
        try {
            $dice = $input->dice;
            $modifiers = $input->modifiers;
            $multiplier = $input->multiplier;

            $rollValue = 0;

            // WIP: Async and enhance performace
            // Enhance performance for large multipliers by processing rolls in chunks and using async tasks
            // Labels: refactor
            // Assignees: valb-mig
            $awaitables = [];
            foreach ($this->generateChunks($multiplier, 250_000) as $chunkSize) {
                $awaitables[] = Async\run(function () use ($chunkSize, $dice): int {
                    $sum = 0;
                    for ($i = 0; $i < $chunkSize; $i++) {
                        $sum += RollDiceAction::roll($dice);
                    }
                    return $sum;
                });
            }

            $rollValue = array_sum(Async\all($awaitables));

            foreach ($modifiers as $modifier) {
                $symbol = $modifier[0];
                $integer = (int) substr($modifier, 1);

                switch ($symbol) {
                    case '+':
                        $rollValue += $integer;
                        break;
                    case '-':
                        $rollValue -= $integer;
                        break;
                    case '*':
                    case 'x':
                        $rollValue *= $integer;
                        break;
                    case '/':
                    case '÷':
                        if ($integer !== 0) {
                            $rollValue /= $integer;
                        }
                        break;
                    default:
                        throw new \InvalidArgumentException("Invalid modifier: {$modifier}");
                }
            }

            $rollValue = (int) ceil($rollValue);

            return Result::success('Success on roll: ' . $rollValue, new RollDiceUseCaseOutput($rollValue));
        } catch (\Exception $e) {
            return Result::error($e->getMessage());
        }
    }

    private function generateChunks(int $multiplier, int $chunkSize): \Generator
    {
        $remaining = $multiplier;
        while ($remaining > 0) {
            yield min($chunkSize, $remaining);
            $remaining -= $chunkSize;
        }
    }
}
