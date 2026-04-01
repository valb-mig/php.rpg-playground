<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects;

/**
 * @template TData
 */
abstract class Bundle
{
    /**
     * @param array<string, TData> $bundleData
     */
    public function __construct(
        private array $bundleData = [],
    ) {}

    /**
     * @param array<string, TData> $bundleData
     * @return static
     */
    public function add(array $bundleData): static
    {
        return new static(array_merge($this->bundleData, $bundleData));
    }

    /**
     * @param string $key
     * @return static
     */
    public function remove(string $key): static
    {
        return new static(array_diff_key($this->bundleData, [$key => true]));
    }

    /**
     * @param string $key
     * @return TData|null
     */
    public function get(string $key): mixed
    {
        return $this->has($key) ? $this->bundleData[$key] : null;
    }

    /** @return array<string, TData> */
    public function show(): array
    {
        return $this->bundleData;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->bundleData);
    }
}
