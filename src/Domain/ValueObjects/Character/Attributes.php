<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\Character;

use RPGPlayground\Domain\ValueObjects\Bundle;

final class Attributes extends Bundle
{
    /**
     * @param Attribute[] $attributes
     */
    public function __construct(Attribute ...$attributes)
    {
        // TODO: make this process more abstract and generic for other classes
        $bundleData = [];

        foreach ($attributes as $attribute) {
            $bundleData[$attribute->key()] = $attribute;
        }

        parent::__construct($bundleData);
    }
}

abstract class Attribute
{
    /**
     * @return string
     */
    abstract public function key(): string;

    /**
     * @return string
     */
    abstract public function description(): string;

    /**
     * @return int
     */
    abstract public function value(): int;
}
