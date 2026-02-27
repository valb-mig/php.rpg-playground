<?php
declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice;

use RPGPlayground\Domain\ValueObjects\App\Dice;
use RPGPlayground\Domain\ValueObjects\Utils\Result;

final class RollDice 
{
    /**
     * @return Result<int|float>
     */
    public function run(
        Dice $dice,
        array $modifiers,
        int $multiplier = 1
    ): Result {
        try {
            $rollage = 0;

            if($multiplier < 1) {
                throw new \InvalidArgumentException("Invalid multiplier");
            }

            for ($i=0; $i < $multiplier; $i++) { 
                $rollage += rand(Dice::MINIMUM_VALUE, $dice->sides);
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
                    default:
                        throw new \InvalidArgumentException("Invalid modifier: {$modifier}");

                }
            }

            return Result::success("d{$dice->sides}: ", $rollage);
        } catch(\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
}