<?php

declare(strict_types=1);

namespace Webkernel\Exceptions\Support;

/**
 * Immutable representation of a single stack trace frame.
 *
 * Built directly from a raw entry of Throwable::getTrace(), without any
 * dependency on Laravel's internal exception renderer (which is not
 * exposed for use outside the default Whoops-style error page).
 */
final readonly class TraceFrame
{
    /**
     * @param array<int, string> $args Pre-formatted argument representations, never raw user values
     */
    private function __construct(
        public string $file,
        public int $line,
        public ?string $class,
        public ?string $type,
        public string $function,
        public array $args,
        public bool $isVendor,
        public ?string $snippet,
    ) {}

    /**
     * Build a frame from a single raw entry of Throwable::getTrace(), paired
     * with the file/line of the *next* frame down (PHP stores file/line on
     * the frame that was executing, not the one being called into).
     *
     * @param array<string, mixed> $rawFrame
     */
    public static function fromRawTraceEntry(
        array $rawFrame,
        string $fallbackFile,
        int $fallbackLine,
        int $snippetRadius = 5,
    ): self {
        $file = (string) ($rawFrame['file'] ?? $fallbackFile);
        $line = (int) ($rawFrame['line'] ?? $fallbackLine);

        return new self(
            file: $file,
            line: $line,
            class: $rawFrame['class'] ?? null,
            type: $rawFrame['type'] ?? null,
            function: (string) ($rawFrame['function'] ?? '{closure}'),
            args: self::formatArgs($rawFrame['args'] ?? []),
            isVendor: self::detectVendor($file),
            snippet: self::extractSnippet($file, $line, $snippetRadius),
        );
    }

    /**
     * Synthesize the topmost frame, representing the exception's own
     * throw site (Throwable::getFile()/getLine()), which never appears
     * inside getTrace() itself.
     */
    public static function fromThrowSite(string $file, int $line, int $snippetRadius = 5): self
    {
        return new self(
            file: $file,
            line: $line,
            class: null,
            type: null,
            function: 'throw',
            args: [],
            isVendor: self::detectVendor($file),
            snippet: self::extractSnippet($file, $line, $snippetRadius),
        );
    }

    public function formattedSource(): string
    {
        $callable = $this->class !== null
            ? $this->class.($this->type ?? '::').$this->function
            : $this->function;

        return $this->function === 'throw'
            ? 'throw'
            : $callable.'('.implode(', ', $this->args).')';
    }

    public function shortFile(string $basePath): string
    {
        $normalized = str_replace('\\', '/', $this->file);
        $base = rtrim(str_replace('\\', '/', $basePath), '/');

        return str_starts_with($normalized, $base)
            ? ltrim(substr($normalized, strlen($base)), '/')
            : $normalized;
    }

    /**
     * @return array<int, string>
     */
    private static function formatArgs(array $rawArgs): array
    {
        return array_map(
            static fn (mixed $arg): string => match (true) {
                is_string($arg) => "'".(strlen($arg) > 30 ? substr($arg, 0, 30).'…' : $arg)."'",
                is_bool($arg) => $arg ? 'true' : 'false',
                is_null($arg) => 'null',
                is_array($arg) => 'array('.count($arg).')',
                is_object($arg) => $arg::class,
                is_scalar($arg) => (string) $arg,
                default => 'mixed',
            },
            $rawArgs,
        );
    }

    private static function detectVendor(string $file): bool
    {
        $normalized = str_replace('\\', '/', $file);

        return str_contains($normalized, '/vendor/');
    }

    private static function extractSnippet(string $file, int $line, int $radius): ?string
    {
        if ($line < 1 || ! is_readable($file)) {
            return null;
        }

        $lines = @file($file, FILE_IGNORE_NEW_LINES);

        if ($lines === false) {
            return null;
        }

        $start = max(0, $line - 1 - $radius);
        $end = min(count($lines), $line + $radius);

        $slice = array_slice($lines, $start, $end - $start);

        return implode("\n", $slice);
    }
}
