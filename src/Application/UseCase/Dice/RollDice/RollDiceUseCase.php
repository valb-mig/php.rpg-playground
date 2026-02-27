<?php
declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use RPGPlayground\Domain\Actions\Dice\RollDiceAction;
use RPGPlayground\Domain\ValueObjects\Utils\Result;

final class RollDiceUseCase
{
    /**
     * @return Result<RollDiceUseCaseOutput>
     */
    public function run(RollDiceUseCaseInput $input): Result {
        try {
            $dice = $input->dice;
            $modifiers = $input->modifiers;
            $multiplier = $input->multiplier;

            $rollage = 0;

            for ($i=0; $i < $multiplier; $i++) { 
                $rollage += RollDiceAction::roll($dice);
            }

            foreach ($modifiers as $modifier) {
                $symbol  = $modifier[0]; 
                $integer = (int) substr($modifier, 1);

                switch ($symbol) {
                    case '+':
                        $rollage += $integer;
                        break;
                    case '-':
                        $rollage -= $integer;
                        break;
                    case '*':
                    case 'x':
                        $rollage *= $integer;
                        break;
                    case '/':
                    case '÷':
                        if ($integer != 0) {
                            $rollage /= $integer;
                        } 
                    break;
                    default:
                        throw new \InvalidArgumentException("Invalid modifier: {$modifier}");
                }
            }

            $rollage = (int) ceil($rollage);

            return Result::success('Success on roll: ' . $rollage, new RollDiceUseCaseOutput($rollage));
        } catch(\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
}