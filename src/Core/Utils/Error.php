<?php

declare(strict_types=1);

namespace RPGPlayground\Core\Utils;

/**
 * Represents an error carried by a failed {@see Result}.
 *
 * Immutable by design — every property is read-only and set only once
 * at construction time. Use the semantic factory methods instead of
 * calling the constructor directly.
 */
final class Error
{
    /**
     * @param string $message  Human-readable description of what went wrong.
     * @param string $code     Machine-readable identifier (e.g. 'VALIDATION_ERROR').
     *                         Used by callers to react to specific error types
     *                         without parsing the message string.
     * @param string $field    The input field that caused the error, if applicable.
     *                         Useful for mapping validation errors back to form fields.
     * @param array  $context  Arbitrary extra data for logging or debugging.
     *                         Never expose this directly to end users.
     */
    public function __construct(
        public readonly string $message,
        public readonly string $code,
        public readonly string $field = '',
        public readonly array $context = [],
    ) {}

    // -------------------------------------------------------------------------
    // Semantic factories
    // -------------------------------------------------------------------------

    /**
     * Creates a generic, unclassified error.
     * Prefer more specific factories when the error type is known.
     */
    public static function generic(string $message): self
    {
        return new self($message, 'GENERIC_ERROR');
    }

    /**
     * Creates a validation error tied to a specific input field.
     *
     * Use when user-provided data does not meet format or constraint rules
     * (e.g. empty required field, invalid e-mail, value out of range).
     *
     * ```php
     * Error::validation('email', 'Must be a valid e-mail address.')
     * Error::validation('age',   'Must be at least 18.')
     * ```
     */
    public static function validation(string $field, string $message): self
    {
        return new self(message: $message, code: 'VALIDATION_ERROR', field: $field);
    }

    /**
     * Creates a not-found error for a given entity and identifier.
     *
     * Use when a resource could not be located based on user-provided input.
     * If the ID came from an internal FK that should always exist, prefer
     * throwing {@see EntityNotFoundException} instead.
     *
     * ```php
     * Error::notFound('User', $id)
     * Error::notFound('Product', $sku)
     * ```
     */
    public static function notFound(string $entity, int|string $id): self
    {
        return new self(message: "{$entity} with id '{$id}' was not found.", code: 'NOT_FOUND', context: [
            'entity' => $entity,
            'id' => $id,
        ]);
    }

    /**
     * Creates a domain / business rule violation error.
     *
     * Use when an operation is structurally valid but violates a business
     * constraint (e.g. discount exceeds the allowed maximum, insufficient
     * balance, order already cancelled).
     *
     * The $code should be a descriptive, domain-specific constant so that
     * callers can react to it programmatically:
     *
     * ```php
     * Error::businessRule('DISCOUNT_LIMIT_EXCEEDED', 'Maximum discount is 50%.', ['requested' => 60])
     * Error::businessRule('INSUFFICIENT_BALANCE',    'Not enough credits.')
     * ```
     */
    public static function businessRule(string $code, string $message, array $context = []): self
    {
        return new self(message: $message, code: $code, context: $context);
    }

    /**
     * Creates an authorization error.
     *
     * Use when the current user does not have permission to perform the
     * requested operation. For missing/invalid credentials, prefer a
     * dedicated authentication exception instead.
     */
    public static function unauthorized(string $message = 'Access denied.'): self
    {
        return new self($message, 'UNAUTHORIZED');
    }

    /**
     * Creates a conflict error.
     *
     * Use when the operation cannot proceed because of a conflicting state
     * (e.g. duplicate e-mail on registration, optimistic lock mismatch).
     *
     * ```php
     * Error::conflict('An account with this e-mail already exists.', ['email' => $email])
     * ```
     */
    public static function conflict(string $message, array $context = []): self
    {
        return new self($message, 'CONFLICT', context: $context);
    }

    // -------------------------------------------------------------------------
    // Output
    // -------------------------------------------------------------------------

    /**
     * Returns a structured array representation of this error.
     *
     * Null values are filtered out so the output stays clean for
     * JSON responses. The $context key is intentionally included only
     * when non-empty — avoid exposing it to end users in production.
     *
     * ```php
     * ['code' => 'VALIDATION_ERROR', 'message' => '...', 'field' => 'email']
     * ```
     */
    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code,
            'message' => $this->message,
            'field' => $this->field ?: null,
            'context' => $this->context ?: null,
        ]);
    }

    /**
     * Returns a human-readable string representation.
     * Prefixes the message with the field name when present.
     *
     * Example output:
     *  - `[email] Must be a valid e-mail address. (VALIDATION_ERROR)`
     *  - `Access denied. (UNAUTHORIZED)`
     */
    public function __toString(): string
    {
        $prefix = $this->field ? "[{$this->field}] " : '';

        return "{$prefix}{$this->message} ({$this->code})";
    }
}
