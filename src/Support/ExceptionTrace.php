<?php

declare(strict_types=1);

namespace Webkernel\Exceptions\Support;

use Throwable;

/**
 * Immutable adapter turning a Throwable into Nightwatch-style frame groups.
 *
 * This intentionally avoids Illuminate\Foundation\Exceptions\Renderer\*,
 * which is wired only into Laravel's own debug error page and is not
 * resolvable when error pages are rendered through a custom Filament-aware
 * exception handler such as ours.
 */
final readonly class ExceptionTrace
{
    /**
     * @param array<int, TraceFrame> $frames
     */
    private function __construct(
        public string $class,
        public string $message,
        public int $code,
        public string $file,
        public int $line,
        public array $frames,
        public ?self $previous,
    ) {}

    public static function capture(Throwable $exception, int $snippetRadius = 5): self
    {
        $throwSite = TraceFrame::fromThrowSite(
            $exception->getFile(),
            $exception->getLine(),
            $snippetRadius,
        );

        $rawTrace = $exception->getTrace();
        $frames = [$throwSite];

        foreach ($rawTrace as $index => $rawFrame) {
            $next = $rawTrace[$index + 1] ?? null;

            $frames[] = TraceFrame::fromRawTraceEntry(
                rawFrame: $rawFrame,
                fallbackFile: $next['file'] ?? $exception->getFile(),
                fallbackLine: $next['line'] ?? $exception->getLine(),
                snippetRadius: $snippetRadius,
            );
        }

        $previous = $exception->getPrevious();

        return new self(
            class: $exception::class,
            message: $exception->getMessage(),
            code: $exception->getCode(),
            file: $exception->getFile(),
            line: $exception->getLine(),
            frames: $frames,
            previous: $previous instanceof Throwable
                ? self::capture($previous, $snippetRadius)
                : null,
        );
    }

    /**
     * Group consecutive frames by vendor/application origin, mirroring
     * Laravel's own frameGroups() collapsing behaviour.
     *
     * @return array<int, array{isVendor: bool, frames: array<int, TraceFrame>}>
     */
    public function frameGroups(): array
    {
        $groups = [];
        $currentGroup = null;

        foreach ($this->frames as $frame) {
            if ($currentGroup === null || $currentGroup['isVendor'] !== $frame->isVendor) {
                if ($currentGroup !== null) {
                    $groups[] = $currentGroup;
                }

                $currentGroup = ['isVendor' => $frame->isVendor, 'frames' => []];
            }

            $currentGroup['frames'][] = $frame;
        }

        if ($currentGroup !== null) {
            $groups[] = $currentGroup;
        }

        return $groups;
    }

    /**
     * @return array<int, self>
     */
    public function previousChain(): array
    {
        $chain = [];
        $current = $this->previous;

        while ($current !== null) {
            $chain[] = $current;
            $current = $current->previous;
        }

        return $chain;
    }

    public function frameCount(): int
    {
        return count($this->frames);
    }

    public function vendorFrameCount(): int
    {
        return count(array_filter($this->frames, static fn (TraceFrame $frame): bool => $frame->isVendor));
    }
}
