@props([
    'frames',
    'basePath',
])

@php
    $count = count($frames);
@endphp

<div
    x-data="{ expanded: false }"
    class="group rounded-lg border border-neutral-200 dark:border-white/5"
    :class="expanded
        ? 'bg-white dark:bg-white/5 shadow-xs'
        : 'border-dashed border-neutral-300 bg-neutral-50 opacity-90 dark:border-white/10 dark:bg-white/[2%]'"
>
    <div
        class="flex h-11 cursor-pointer items-center gap-3 rounded-lg pl-4 pr-2.5 hover:bg-white/50 dark:hover:bg-white/[2%]"
        @click="expanded = !expanded"
    >
        <x-heroicon-o-folder class="h-3 w-3 text-neutral-400" x-show="!expanded" x-cloak />
        <x-heroicon-o-folder-open class="h-3 w-3 text-blue-500 dark:text-emerald-500" x-show="expanded" />

        <div class="flex-1 font-mono text-xs leading-3 text-neutral-700 dark:text-neutral-400">
            {{ $count }} {{ __('vendor') }} {{ Illuminate\Support\Str::plural('frame', $count) }}
        </div>

        <button
            type="button"
            class="flex h-6 w-6 flex-shrink-0 cursor-pointer items-center justify-center rounded-md dark:border dark:border-white/8"
            :class="expanded ? 'text-blue-500 dark:text-emerald-500 dark:bg-white/5' : 'text-neutral-500 dark:bg-white/3'"
        >
            <x-filament::icon icon="heroicon-o-chevron-up" class="h-3 w-3" x-show="expanded" x-cloak />
            <x-filament::icon icon="heroicon-o-chevron-down" class="h-3 w-3" x-show="!expanded" />
        </button>
    </div>

    <div
        x-show="expanded"
        x-cloak
        class="flex flex-col divide-y divide-neutral-200 rounded-b-lg border-t border-neutral-200 dark:divide-white/5 dark:border-white/5"
    >
        @foreach ($frames as $frame)
            <div class="grid gap-2 overflow-x-auto bg-neutral-50 p-4 dark:bg-transparent">
                <span
                    class="truncate font-mono text-xs text-neutral-600 dark:text-neutral-300"
                    data-tippy-content="{{ $frame->formattedSource() }}"
                >{{ $frame->formattedSource() }}</span>
                <span class="truncate font-mono text-xs text-neutral-500 dark:text-neutral-400">
                    {{ $frame->shortFile($basePath) }}<span class="text-neutral-400">:{{ $frame->line }}</span>
                </span>
            </div>
        @endforeach
    </div>
</div>
