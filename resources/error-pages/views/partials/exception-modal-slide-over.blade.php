@props(['exception'])

@php
    use Webkernel\Exceptions\Support\ExceptionTrace;

    /** @var ExceptionTrace $trace */
    $trace = ExceptionTrace::capture($exception);
    $basePath = webapp_path();
@endphp

<x-filament::modal
    id="exception-trace-slide-over"
    slide-over
    icon="heroicon-o-bug-ant"
    icon-color="danger"
    width="7xl"
    :close-by-clicking-away="false"
    sticky-header
    sticky-footer
>
    <x-slot name="heading">{{ __('Exception trace') }}</x-slot>

    <div class="space-y-6">
        {{-- Identity --}}
        <div class="space-y-1.5">
            <h3 class="break-all font-mono text-base font-semibold text-neutral-900 dark:text-white">
                {{ $trace->class }}
            </h3>
            <p class="text-sm font-light text-neutral-600 dark:text-neutral-300">
                {{ $trace->message ?: __('No message provided.') }}
            </p>
            <div class="font-mono text-xs text-neutral-500 dark:text-neutral-400">
                <span data-tippy-content="{{ $trace->file }}:{{ $trace->line }}">
                    {{ $trace->file }}<span class="text-neutral-400">:{{ $trace->line }}</span>
                </span>
            </div>
        </div>

        <div class="flex items-center gap-1.5">
            <span class="inline-flex h-6 items-center gap-1 rounded-md bg-black/8 px-1.5 font-mono text-xs uppercase text-neutral-900 dark:bg-white/10 dark:text-neutral-100">
                {{ $trace->frameCount() }} {{ __('frames') }}
            </span>
            <span class="inline-flex h-6 items-center gap-1 rounded-md bg-black/8 px-1.5 font-mono text-xs uppercase text-neutral-900 dark:bg-white/10 dark:text-neutral-100">
                {{ $trace->vendorFrameCount() }} {{ __('vendor') }}
            </span>
            @if ($trace->code)
                <span class="inline-flex h-6 items-center gap-1 rounded-md bg-rose-600 px-1.5 font-mono text-xs uppercase text-white">
                    {{ __('Code') }} {{ $trace->code }}
                </span>
            @endif
        </div>

        {{-- Trace --}}
        <div class="flex flex-col gap-2.5 rounded-xl border border-neutral-200 bg-neutral-50 p-2.5 shadow-xs dark:border-neutral-800 dark:bg-white/[2%]">
            <div class="flex items-center gap-2.5 p-2">
                <div class="flex h-6 w-6 items-center justify-center rounded-md border border-neutral-200 bg-white p-1 dark:border-white/5 dark:bg-neutral-800">
                    <x-filament::icon icon="heroicon-o-exclamation-triangle" class="h-2.5 w-2.5 text-blue-500 dark:text-emerald-500" />
                </div>
                <h4 class="text-sm font-semibold text-neutral-900 dark:text-white">{{ __('Stack trace') }}</h4>
            </div>

            <div class="flex flex-col gap-1.5">
                @foreach ($trace->frameGroups() as $groupIndex => $group)
                    @if ($group['isVendor'])
                        @include('partials.exception-trace.vendor-group',
                        [
                            'frames'    => $group['frames'],
                            'base-path' => $basePath,
                        ])
                    @else
                        @foreach ($group['frames'] as $frame)
                            @include('errors::partials.exception-trace.frame',
                            [
                                'frames'    => $group['frames'],
                                'base-path' => $basePath,
                                'expanded' =>  $groupIndex === 0 && $loop->first
                            ])
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Previous exceptions --}}
        @if ($trace->previousChain() !== [])
            <div class="flex flex-col gap-2.5 rounded-xl border border-neutral-200 bg-neutral-50 p-2.5 shadow-xs dark:border-neutral-800 dark:bg-white/[2%]">
                <div class="flex items-center gap-2.5 p-2">
                    <div class="flex h-6 w-6 items-center justify-center rounded-md border border-neutral-200 bg-white p-1 dark:border-white/5 dark:bg-neutral-800">
                        <x-filament::icon icon="heroicon-o-arrow-path" class="h-2.5 w-2.5 text-blue-500 dark:text-emerald-500" />
                    </div>
                    <h4 class="text-sm font-semibold text-neutral-900 dark:text-white">
                        {{ __('Previous') }} {{ Illuminate\Support\Str::plural('exception', count($trace->previousChain())) }}
                    </h4>
                </div>

                <div class="flex flex-col gap-1.5 px-2 pb-2">
                    @foreach ($trace->previousChain() as $previous)
                        @include('errors::partials.exception-trace.previous-item',
                            [
                                'trace' => $previous
                            ]
                        )
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <x-slot name="footer">
        <x-filament::button
            color="gray"
            x-on:click="$dispatch('close-modal', { id: 'exception-trace-slide-over' })"
        >{{ __('Close') }}</x-filament::button>
    </x-slot>
</x-filament::modal>
