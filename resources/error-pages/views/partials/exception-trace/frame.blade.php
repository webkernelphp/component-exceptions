@props([
    'frame',
    'basePath',
    'expanded' => false,
])

@php
    /** @var \Webkernel\Exceptions\Support\TraceFrame $frame */
@endphp

<div
    x-data="{ expanded: {{ $expanded ? 'true' : 'false' }}, hasCode: {{ $frame->snippet !== null ? 'true' : 'false' }} }"
    class="group overflow-hidden rounded-lg border border-neutral-200 shadow-xs dark:border-white/10"
>
    <div
        class="flex h-11 items-center gap-3 overflow-x-auto bg-white pl-4 pr-2.5 dark:bg-white/[3%]"
        :class="{
            'cursor-pointer hover:bg-neutral-50 dark:hover:bg-white/5': hasCode,
            'dark:bg-white/5 rounded-t-lg': expanded,
            'rounded-lg': !expanded,
        }"
        @click="hasCode && (expanded = !expanded)"
    >
        <div class="flex h-3 w-3 flex-shrink-0 items-center justify-center">
            <div
                class="h-2 w-2 rounded-full"
                :class="expanded ? 'bg-rose-500 dark:bg-neutral-400' : 'bg-rose-200 dark:bg-neutral-700'"
            ></div>
        </div>

        <div class="flex min-w-0 flex-1 items-center justify-between gap-6">
            <span
                class="min-w-0 truncate font-mono text-xs text-neutral-700 dark:text-neutral-200"
                data-tippy-content="{{ $frame->formattedSource() }}"
            >{{ $frame->formattedSource() }}</span>

            <span class="flex-shrink-0 truncate font-mono text-xs text-neutral-500 dark:text-neutral-400" dir="rtl">
                <span data-tippy-content="{{ $frame->file }}:{{ $frame->line }}">
                    {{ $frame->shortFile($basePath) }}<span class="text-neutral-400">:{{ $frame->line }}</span>
                </span>
            </span>
        </div>

        @if ($frame->snippet !== null)
            <div class="flex-shrink-0">
                <button
                    type="button"
                    class="flex h-6 w-6 cursor-pointer items-center justify-center rounded-md dark:border dark:border-white/8"
                    :class="expanded ? 'text-blue-500 dark:text-emerald-500 dark:bg-white/5' : 'text-neutral-500 dark:bg-white/3'"
                >
                    <x-filament::icon icon="heroicon-o-chevron-up" class="h-3 w-3" x-show="expanded" x-cloak />
                    <x-filament::icon icon="heroicon-o-chevron-down" class="h-3 w-3" x-show="!expanded" />
                </button>
            </div>
        @endif
    </div>

    @if ($frame->snippet !== null)
        <div
            x-show="expanded"
            x-cloak="{{ $expanded ? 'false' : 'true' }}"
            class="border-t border-neutral-100 bg-neutral-50 text-sm dark:border-white/10 dark:bg-neutral-900"
        >
            <pre class="overflow-x-auto p-3 text-xs leading-relaxed text-neutral-700 dark:text-neutral-300"><code>{{ $frame->snippet }}</code></pre>
        </div>
    @endif
</div>
