<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Events\Dice;

use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Contracts\Event\RPGSessionEventContract;
use RPGKernel\Domain\Enums\Roll\RollAttribute;
use RPGKernel\Domain\ValueObjects\Dice;

class RollDiceEvent implements RPGSessionEventContract
{
    /**
     * @param Identifier $sessionId The identifier of the session
     * @param Dice $dice The dice to roll
     * @param RollModifier[] $modifiers The modifiers to apply to the roll
     * @param int $multiplier The number of times to roll the dice
     * @param RollAttribute $attribute The attributes to apply to the roll
     * @param int $rollValue The result of the roll
     */
    public function __construct(
        public readonly Identifier $sessionId,
        public readonly Dice $dice,
        public readonly array $modifiers,
        public readonly int $multiplier,
        public readonly ?RollAttribute $attribute,
        public readonly int $rollValue,
    ) {}

    public function occurredAt(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }

    public function sessionId(): Identifier
    {
        return $this->sessionId;
    }

    public function eventType(): string
    {
        return 'dice.roll';
    }

    public function payload(): array
    {
        return [
            'sessionId' => $this->sessionId()->value,
            'type' => $this->eventType(),
            'rollValue' => $this->rollValue,
            'dice' => $this->dice->sides,
            'multiplier' => $this->multiplier,
            'attribute' => $this->attribute,
            'modifiers' => $this->modifiers,
            'createdAt' => $this->occurredAt()->format('Y-m-d H:i:s'),
        ];
    }
}
