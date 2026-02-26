<?php
declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice;

use RPGPlayground\Domain\Entities\Dice;
use RPGPlayground\Domain\ValueObjects\App\Result;

final class RollDice 
{
    public function run(
        Dice $dice,
        array $modifiers,
        int $multiplier = 1
    ): Result {
        try {
            $rollage = 0;

            for ($i=0; $i < $multiplier; $i++) { 
                $rollage += rand(Dice::MINIMUN_VALUE, $dice->getDiceMaximum());
            }

            foreach ($modifiers as $modifier) {
                $symbol = $modifier[0]; 
                
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
                        if ($integer != 0) {
                            $rollage /= $integer;
                        }
                    break;

                }
            }

            return Result::success("d{$dice->getDiceMaximum()}: ", $rollage);
        } catch(\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
}