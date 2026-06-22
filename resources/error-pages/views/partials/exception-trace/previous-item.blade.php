@props(['trace'])

@php
    /** @var \Webkernel\Exceptions\Support\ExceptionTrace $trace */
    $basePath = webapp_path();
@endphp

<div
    x-data="{ expanded: false }"
    class="group/exception flex-1 rounded-lg"
    :class="expanded
        ? 'border border-neutral-200 bg-white/50 dark:border-white/5 dark:bg-white/[2%]'
        : 'border border-neutral-200 dark:border-transparent dark:bg-white/[2%]'"
>
    <div
        class="flex cursor-pointer gap-2.5 rounded-lg p-3"
        :class="{ 'hover:bg-white/50 dark:hover:bg-white/[2%]': !expanded }"
        @click="expanded = !expanded"
    >
        <div class="min-w-0 flex-1" :class="expanded ? 'flex flex-col' : 'flex items-baseline gap-2'">
            <h5 class="max-w-full flex-shrink-0 truncate font-mono text-sm font-medium text-neutral-900 dark:text-white">
                {{ $trace->class }}
            </h5>
            <p
                class="text-sm text-neutral-500 dark:text-neutral-400"
                :class="expanded ? 'mt-1 break-words' : 'truncate'"
            >{{ $trace->message }}</p>
        </div>

        <button
            type="button"
            class="flex h-6 w-6 flex-shrink-0 cursor-pointer items-center justify-center rounded-md border border-neutral-200 dark:border-white/8"
            :class="expanded ? 'text-blue-500 dark:text-emerald-500 dark:bg-white/5' : 'text-neutral-500 dark:bg-white/3'"
        >
            <x-filament::icon icon="heroicon-o-chevron-up" class="h-3 w-3" x-show="expanded" x-cloak />
            <x-filament::icon icon="heroicon-o-chevron-down" class="h-3 w-3" x-show="!expanded" />
        </button>
    </div>

    <div x-show="expanded" x-cloak class="flex flex-col gap-1.5 p-3">
        @foreach ($trace->frameGroups() as $group)
            @if ($group['isVendor'])
                @include('errors::partials.exception-trace.vendor-group',
                    [
                    'frames'    => $group['frames'],
                    'base-path' => $basePath
                    ]
                )
            @else
                @foreach ($group['frames'] as $frame)
                    @include('errors::partials.exception-trace.frame',
                        [
                        'frames'    => $frame,
                        'base-path' => $basePath
                        ]
                    )
                @endforeach
            @endif
        @endforeach
    </div>
</div>
