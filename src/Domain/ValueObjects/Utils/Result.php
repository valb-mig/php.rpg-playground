<?php
declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\Utils;

/**
 * @template T
 */
final class Result
{
    private const SUCCESS = 'success';
    private const ERROR = 'error';

    /**
     * @param T $data
     */
    private function __construct(
        private readonly string $type,
        private readonly string $message,
        private readonly mixed $data
    ) {  }

    /**
     * @template TValue
     * @param TValue $data
     * @return self<TValue>
     */
    public static function success(string $message, mixed $data = null): self
    {
        return new self(self::SUCCESS, $message, $data);
    }

    /**
     * @template TValue
     * @param TValue $data
     * @return self<TValue>
     */
    public static function error(string $message, mixed $data = null): self
    {
        return new self(self::ERROR, $message, $data);
    }

    /**
     * @return T
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function isError(): bool
    {
        return $this->type === self::ERROR;
    }

    public function isSuccess(): bool
    {
        return $this->type === self::SUCCESS;
    }
}