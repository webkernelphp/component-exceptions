@props(['exception'])

    <x-filament::modal
        id="debug-exception-modal"
        icon="heroicon-o-bug-ant"
        icon-color="danger"
        width="2xl"
        :close-by-clicking-away="false"
    >
        <x-slot name="heading">{{ __('Exception') }}</x-slot>

        <div class="space-y-4 font-mono">
            <div class="flex items-center gap-2">
                <span class="inline-flex h-6 items-center rounded-md bg-rose-200 px-1.5 text-xs font-semibold uppercase tracking-wide text-rose-900 dark:bg-rose-950 dark:text-rose-100">
                    {{ $exception->getCode() ?: 'ERR' }}
                </span>
                <span class="truncate text-sm font-semibold text-neutral-900 dark:text-white">
                    {{ $exception::class }}
                </span>
            </div>

            <p class="text-sm text-neutral-600 dark:text-neutral-300">
                {{ $exception->getMessage() ?: __('No message provided.') }}
            </p>

            <div class="rounded-md border border-neutral-200 bg-neutral-50 px-3 py-2 text-xs text-neutral-500 dark:border-white/10 dark:bg-white/3 dark:text-neutral-400">
                <span data-tippy-content="{{ $exception->getFile() }}:{{ $exception->getLine() }}">
                    {{ $exception->getFile() }}<span class="text-neutral-400">:{{ $exception->getLine() }}</span>
                </span>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-filament::button
                    color="gray"
                    x-on:click="$dispatch('close-modal', { id: 'debug-exception-modal' })"
                >{{ __('Close') }}</x-filament::button>

                <x-filament::button
                    color="danger"
                    icon="heroicon-o-bug-ant"
                    x-on:click="
                        $dispatch('close-modal', { id: 'debug-exception-modal' });
                        $dispatch('open-modal', { id: 'exception-trace-slide-over' });
                    "
                >{{ __('View full trace') }}</x-filament::button>
            </div>
        </x-slot>
    </x-filament::modal>
    @include('errors::partials.exception-modal-slide-over')
