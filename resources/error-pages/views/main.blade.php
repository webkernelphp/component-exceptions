@props([
    'errorCode' => '500',
    'exception' => null,
])
@php
    $errorCode = (int) $errorCode;
    $config = match ($errorCode) {
        400 => [
            'icon'        => 'heroicon-o-exclamation-circle',
            'title'       => 'Bad Request',
            'description' => 'The request could not be understood by the server due to malformed syntax. Please check your input and try again.',
            'accent'      => 'warning',
        ],
        401 => [
            'icon'        => 'heroicon-o-lock-closed',
            'title'       => 'Unauthorized',
            'description' => 'You need to be authenticated to access this resource. Please log in and try again.',
            'accent'      => 'warning',
        ],
        402 => [
            'icon'        => 'heroicon-o-credit-card',
            'title'       => 'Payment Required',
            'description' => 'Access to this resource requires a valid payment. Please check your subscription or billing details.',
            'accent'      => 'warning',
        ],
        403 => [
            'icon'        => 'heroicon-o-no-symbol',
            'title'       => 'Access Forbidden',
            'description' => 'You don\'t have permission to access this page. Please contact your administrator if you believe this is a mistake.',
            'accent'      => 'warning',
        ],
        404 => [
            'icon'        => 'heroicon-o-globe-alt',
            'title'       => 'Page Not Found',
            'description' => 'We can\'t find the page you\'re looking for. It might have been moved, deleted, or the link might be broken. Don\'t worry, your inbox is safe and sound.',
            'accent'      => 'gray',
        ],
        405 => [
            'icon'        => 'heroicon-o-minus-circle',
            'title'       => 'Method Not Allowed',
            'description' => 'The HTTP method used is not supported for this endpoint. Please check the API documentation.',
            'accent'      => 'warning',
        ],
        406 => [
            'icon'        => 'heroicon-o-adjustments-horizontal',
            'title'       => 'Not Acceptable',
            'description' => 'The server cannot produce a response matching the list of acceptable values defined in your request headers.',
            'accent'      => 'warning',
        ],
        407 => [
            'icon'        => 'heroicon-o-shield-check',
            'title'       => 'Proxy Authentication Required',
            'description' => 'You must authenticate with a proxy server before this request can be served.',
            'accent'      => 'warning',
        ],
        408 => [
            'icon'        => 'heroicon-o-clock',
            'title'       => 'Request Timeout',
            'description' => 'The server timed out waiting for the request. Please check your connection and try again.',
            'accent'      => 'warning',
        ],
        409 => [
            'icon'        => 'heroicon-o-arrows-right-left',
            'title'       => 'Conflict',
            'description' => 'The request could not be completed due to a conflict with the current state of the resource.',
            'accent'      => 'warning',
        ],
        410 => [
            'icon'        => 'heroicon-o-trash',
            'title'       => 'Gone',
            'description' => 'The resource you requested has been permanently removed and is no longer available.',
            'accent'      => 'gray',
        ],
        411 => [
            'icon'        => 'heroicon-o-arrows-up-down',
            'title'       => 'Length Required',
            'description' => 'The server requires a Content-Length header for this request.',
            'accent'      => 'warning',
        ],
        412 => [
            'icon'        => 'heroicon-o-clipboard-document-check',
            'title'       => 'Precondition Failed',
            'description' => 'One or more conditions in the request headers were not met.',
            'accent'      => 'warning',
        ],
        413 => [
            'icon'        => 'heroicon-o-arrow-up-tray',
            'title'       => 'Payload Too Large',
            'description' => 'The request payload exceeds the maximum size allowed by the server.',
            'accent'      => 'warning',
        ],
        414 => [
            'icon'        => 'heroicon-o-link',
            'title'       => 'URI Too Long',
            'description' => 'The URI provided was too long for the server to process.',
            'accent'      => 'warning',
        ],
        415 => [
            'icon'        => 'heroicon-o-document',
            'title'       => 'Unsupported Media Type',
            'description' => 'The media format of the request is not supported by the server.',
            'accent'      => 'warning',
        ],
        416 => [
            'icon'        => 'heroicon-o-scissors',
            'title'       => 'Range Not Satisfiable',
            'description' => 'The range specified in the request headers cannot be fulfilled by the server.',
            'accent'      => 'warning',
        ],
        417 => [
            'icon'        => 'heroicon-o-chat-bubble-bottom-center-text',
            'title'       => 'Expectation Failed',
            'description' => 'The server cannot meet the requirements of the Expect request-header field.',
            'accent'      => 'warning',
        ],
        418 => [
            'icon'        => 'heroicon-o-face-smile',
            'title'       => 'I\'m a Teapot',
            'description' => 'The server refuses to brew coffee because it is, permanently, a teapot.',
            'accent'      => 'gray',
        ],
        421 => [
            'icon'        => 'heroicon-o-arrow-path-rounded-square',
            'title'       => 'Misdirected Request',
            'description' => 'The request was directed at a server that is not able to produce a response.',
            'accent'      => 'warning',
        ],
        422 => [
            'icon'        => 'heroicon-o-exclamation-triangle',
            'title'       => 'Unprocessable Entity',
            'description' => 'The request was well-formed but contains semantic errors that prevent it from being processed.',
            'accent'      => 'warning',
        ],
        423 => [
            'icon'        => 'heroicon-o-lock-closed',
            'title'       => 'Locked',
            'description' => 'The resource you are trying to access is locked and cannot be modified at this time.',
            'accent'      => 'warning',
        ],
        424 => [
            'icon'        => 'heroicon-o-link',
            'title'       => 'Failed Dependency',
            'description' => 'The request failed because it depended on another request that failed.',
            'accent'      => 'warning',
        ],
        425 => [
            'icon'        => 'heroicon-o-clock',
            'title'       => 'Too Early',
            'description' => 'The server is unwilling to risk processing a request that might be replayed.',
            'accent'      => 'warning',
        ],
        426 => [
            'icon'        => 'heroicon-o-arrow-up-circle',
            'title'       => 'Upgrade Required',
            'description' => 'The client should switch to a different protocol as specified in the Upgrade header.',
            'accent'      => 'warning',
        ],
        428 => [
            'icon'        => 'heroicon-o-clipboard-document-check',
            'title'       => 'Precondition Required',
            'description' => 'The server requires the request to be conditional to prevent conflicts.',
            'accent'      => 'warning',
        ],
        429 => [
            'icon'        => 'heroicon-o-fire',
            'title'       => 'Too Many Requests',
            'description' => 'You have sent too many requests in a short period. Please slow down and try again in a moment.',
            'accent'      => 'warning',
        ],
        431 => [
            'icon'        => 'heroicon-o-bars-3',
            'title'       => 'Request Header Fields Too Large',
            'description' => 'The server is unwilling to process the request because its header fields are too large.',
            'accent'      => 'warning',
        ],
        451 => [
            'icon'        => 'heroicon-o-scale',
            'title'       => 'Unavailable For Legal Reasons',
            'description' => 'Access to this resource has been denied for legal reasons, such as a court order or government regulation.',
            'accent'      => 'danger',
        ],
        500 => [
            'icon'        => 'heroicon-o-server',
            'title'       => 'Internal Server Error',
            'description' => 'Something went wrong on our end. Our team has been notified and is working on a fix. Please try again in a few minutes.',
            'accent'      => 'danger',
        ],
        501 => [
            'icon'        => 'heroicon-o-code-bracket',
            'title'       => 'Not Implemented',
            'description' => 'The server does not support the functionality required to fulfill this request.',
            'accent'      => 'danger',
        ],
        502 => [
            'icon'        => 'heroicon-o-server',
            'title'       => 'Bad Gateway',
            'description' => 'The server received an invalid response from an upstream server. Please try again in a few minutes.',
            'accent'      => 'danger',
        ],
        503 => [
            'icon'        => 'heroicon-o-server',
            'title'       => 'Service Unavailable',
            'description' => 'Our servers are temporarily unable to handle your request. We\'re working on it — please try again shortly.',
            'accent'      => 'danger',
        ],
        504 => [
            'icon'        => 'heroicon-o-clock',
            'title'       => 'Gateway Timeout',
            'description' => 'The server did not receive a timely response from an upstream server. Please try again in a moment.',
            'accent'      => 'danger',
        ],
        505 => [
            'icon'        => 'heroicon-o-code-bracket',
            'title'       => 'HTTP Version Not Supported',
            'description' => 'The server does not support the HTTP protocol version used in the request.',
            'accent'      => 'danger',
        ],
        506 => [
            'icon'        => 'heroicon-o-arrows-pointing-out',
            'title'       => 'Variant Also Negotiates',
            'description' => 'The server has an internal configuration error and cannot complete the request.',
            'accent'      => 'danger',
        ],
        507 => [
            'icon'        => 'heroicon-o-circle-stack',
            'title'       => 'Insufficient Storage',
            'description' => 'The server is unable to store the representation needed to complete the request.',
            'accent'      => 'danger',
        ],
        508 => [
            'icon'        => 'heroicon-o-arrow-path',
            'title'       => 'Loop Detected',
            'description' => 'The server detected an infinite loop while processing the request.',
            'accent'      => 'danger',
        ],
        510 => [
            'icon'        => 'heroicon-o-puzzle-piece',
            'title'       => 'Not Extended',
            'description' => 'Further extensions to the request are required for the server to fulfill it.',
            'accent'      => 'danger',
        ],
        511 => [
            'icon'        => 'heroicon-o-wifi',
            'title'       => 'Network Authentication Required',
            'description' => 'You need to authenticate with the network before you can access this resource.',
            'accent'      => 'warning',
        ],
        default => [
            'icon'        => 'heroicon-o-exclamation-circle',
            'title'       => 'Something Went Wrong',
            'description' => 'An unexpected error occurred. Please refresh the page or try again later. If the problem persists, contact support.',
            'accent'      => 'gray',
        ],
    };

    $icon         = $config['icon'];
    $title        = $config['title'];
    $description  = $config['description'];
    $accent       = $config['accent'] ?? 'danger';
    $accentKey    = in_array($accent, ['danger', 'gray', 'info', 'success', 'warning'], true) ? $accent : 'danger';
    $isDebuggable = ! app()->isProduction() && $exception instanceof \Throwable;
@endphp

<x-webkernel::webpage :title="'Error ' . $errorCode">
    <style>
    /* ─── Page shell ─────────────────────────────────────────── */
    .wk-error-shell {
        position: relative;
        display: flex;
        min-height: 100dvh;
        width: 100%;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 3rem 1rem;
        -webkit-font-smoothing: antialiased;
        background:
            radial-gradient(ellipse 70% 50% at 50% 0%,
                var(--wk-accent-ambient) 0%,
                transparent 70%),
            linear-gradient(to bottom, #f8fafc, #f1f5f9);
    }
    .dark .wk-error-shell {
        background:
            radial-gradient(ellipse 70% 50% at 50% 0%,
                var(--wk-accent-ambient-dark) 0%,
                transparent 70%),
            linear-gradient(to bottom, #000, #0f172a);
    }

    /* ─── Per-accent CSS variables ───────────────────────────── */
    .wk-accent-danger {
        --wk-accent-ambient:      rgba(239,68,68,.06);
        --wk-accent-ambient-dark: rgba(239,68,68,.08);
        --wk-accent-color:        #ef4444;
        --wk-accent-color-dark:   rgba(239,68,68,.35);
    }
    .wk-accent-warning {
        --wk-accent-ambient:      rgba(234,179,8,.06);
        --wk-accent-ambient-dark: rgba(234,179,8,.08);
        --wk-accent-color:        #eab308;
        --wk-accent-color-dark:   rgba(234,179,8,.30);
    }
    .wk-accent-gray {
        --wk-accent-ambient:      rgba(100,116,139,.05);
        --wk-accent-ambient-dark: rgba(148,163,184,.06);
        --wk-accent-color:        #94a3b8;
        --wk-accent-color-dark:   rgba(148,163,184,.25);
    }
    .wk-accent-info {
        --wk-accent-ambient:      rgba(59,130,246,.06);
        --wk-accent-ambient-dark: rgba(59,130,246,.08);
        --wk-accent-color:        #3b82f6;
        --wk-accent-color-dark:   rgba(59,130,246,.30);
    }
    .wk-accent-success {
        --wk-accent-ambient:      rgba(34,197,94,.06);
        --wk-accent-ambient-dark: rgba(34,197,94,.08);
        --wk-accent-color:        #22c55e;
        --wk-accent-color-dark:   rgba(34,197,94,.28);
    }

    /* ─── Watermark — z-index: 0, couleur accent visible ─────── */
    .wk-error-watermark {
        position: absolute;
        inset: 0;
        z-index: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        user-select: none;
        font-family: 'Space Grotesk', system-ui, sans-serif;
        letter-spacing: -0.06em;
        line-height: 1;
        font-size: clamp(140px, 35vw, 480px);

        color: var(--wk-accent-color);
        opacity: .28;

        -webkit-backdrop-filter: blur(0px);
        backdrop-filter: blur(0px);
    }

    .dark .wk-error-watermark {
        color: var(--wk-accent-color);
        opacity: 0.22;
        filter:
            drop-shadow(0 0 80px var(--wk-accent-color))
            drop-shadow(0 2px 12px rgba(0,0,0,0.5));
    }

    @media (max-width: 767px) {
        .wk-error-watermark {
            padding-bottom: 18rem;
        }
    }

    /* ─── Floating decorative chips ─────────────────────────── */
    .wk-error-chip {
        position: absolute;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.625rem;
        background: rgba(255,255,255,0.55);
        border: 1px solid rgba(255,255,255,0.8);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        color: var(--gray-400);
        width: 2rem;
        height: 2rem;
    }
    .dark .wk-error-chip {
        background: rgba(255,255,255,0.04);
        border-color: rgba(255,255,255,0.08);
        box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        color: var(--gray-500);
    }

    /* ─── Main card ──────────────────────────────────────────── */
    .wk-error-card {
        position: relative;
        z-index: 40;
        padding: 3.5rem 2rem;
        text-align: center;
    }
    @media (min-width: 640px) {
        .wk-error-card { padding: 3.5rem 3.5rem; }
        .wk-error-watermark { padding-bottom: 24rem; }
    }

    /* ─── Concentric rings ───────────────────────────────────── */
    .wk-error-ring-outer,
    .wk-error-ring-inner {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 1px solid var(--gray-200);
    }
    .dark .wk-error-ring-outer,
    .dark .wk-error-ring-inner { border-color: var(--gray-800); }
    .wk-error-ring-inner { inset: 0.75rem; }

    /* ─── Icon glyph box ─────────────────────────────────────── */
    .wk-error-glyph {
        position: relative;
        z-index: 50;
        display: flex;
        width: 4rem;
        height: 4rem;
        align-items: center;
        justify-content: center;
        border-radius: 1rem;
        background: rgba(255,255,255,0.75);
        border: 1px solid rgba(255,255,255,0.9);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow:
            0 4px 16px rgba(0,0,0,0.07),
            inset 0 1px 0 rgba(255,255,255,0.9);
    }
    .dark .wk-error-glyph {
        background: rgba(30,41,59,0.7);
        border-color: rgba(255,255,255,0.07);
        box-shadow:
            0 4px 20px rgba(0,0,0,0.4),
            inset 0 1px 0 rgba(255,255,255,0.06);
    }

    /* ─── Typography ─────────────────────────────────────────── */
    .wk-error-title {
        color: var(--gray-950);
        font-family: 'Space Grotesk', system-ui, sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: -0.03em;
        position: relative;
        z-index: 40;
    }
    @media (min-width: 640px) { .wk-error-title { font-size: 1.875rem; } }
    .dark .wk-error-title { color: var(--gray-50); }

    .wk-error-description {
        color: var(--gray-500);
        font-size: 0.875rem;
        line-height: 1.625;
        margin: 0.75rem auto 0;
        max-width: 28rem;
        position: relative;
        z-index: 40;
    }
    @media (min-width: 640px) { .wk-error-description { font-size: 1rem; } }
    .dark .wk-error-description { color: var(--gray-400); }

    /* ─── Accent icon colours ────────────────────────────────── */
    .wk-icon-danger  { color: var(--danger-500);  }
    .wk-icon-gray    { color: var(--gray-500);    }
    .wk-icon-warning { color: var(--warning-500); }
    .wk-icon-info    { color: var(--info-500);    }
    .wk-icon-success { color: var(--success-500); }

    /* ─── Float animation ────────────────────────────────────── */
    @keyframes wk-float {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-6px); }
    }
    .wk-floating { animation: wk-float 5s ease-in-out infinite; }
    </style>
    <div
        x-data="{ debugOpen: false }"
        class="wk-error-shell wk-accent-{{ $accentKey }}"
        style="user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;"
        @copy.prevent
        @contextmenu.prevent
    >
        {{-- ── Giant glassmorphic watermark — z-index: 0 ────────── --}}
        <div
            aria-hidden="true"
            class="wk-error-watermark"
            style="color: var(--{{ $accentKey }}-400);"
        >{{ $errorCode }}</div>

        {{-- ── Floating decorative chips — z-index: 10 ─────────── --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 hidden sm:block">
            <div class="wk-error-chip wk-floating" style="left:22%;top:18%;animation-delay:0s">
                <x-filament::icon icon="heroicon-o-link" class="h-4 w-4" />
            </div>
            <div class="wk-error-chip wk-floating" style="left:40%;top:10%;animation-delay:.6s">
                <x-filament::icon icon="heroicon-o-archive-box" class="h-4 w-4" />
            </div>
            <div class="wk-error-chip wk-floating" style="right:18%;top:16%;animation-delay:1.1s">
                <x-filament::icon icon="heroicon-o-document-magnifying-glass" class="h-4 w-4" />
            </div>
            <div class="wk-error-chip wk-floating" style="left:16%;top:42%;animation-delay:1.6s">
                <x-filament::icon icon="heroicon-o-inbox" class="h-4 w-4" />
            </div>
            <div class="wk-error-chip wk-floating" style="right:26%;top:44%;animation-delay:.3s">
                <x-filament::icon icon="heroicon-o-chat-bubble-left" class="h-4 w-4" />
            </div>
        </div>

        {{-- ── Main content card — z-index: 40 ─────────────────── --}}
        <div class="wk-error-card">

            {{-- Rings + glyph --}}
            <div class="relative mx-auto mb-8 flex h-32 w-32 items-center justify-center" style="z-index:50">

            </div>
            <h1 class="wk-error-title flex items-center justify-center gap-2">
                <x-filament::icon :icon="$icon" style="width:30px;height:30px"/>
                <span>{{ $title }}</span>
            </h1>

            <p class="wk-error-description">{{ $description }}</p>

            <div class="relative mt-8 flex flex-wrap items-center justify-center gap-3" style="z-index:40">
                <x-filament::button color="{{ $accent }}" tag="a" :href="url('/')">
                    Go to Home
                </x-filament::button>
                @if ($isDebuggable)
                    <x-filament::button
                        color="gray"
                        icon="heroicon-o-bug-ant"
                        x-on:click="$dispatch('open-modal', { id: 'debug-exception-modal' })"
                    >
                        {{ __('View Details') }}
                    </x-filament::button>
                @endif
            </div>

            <div class="relative mt-10 flex flex-col items-center gap-3" style="z-index:40">
                @includeIf('filament-panels::components.theme-switcher.index')
                <p class="text-xs font-medium uppercase tracking-widest text-gray-400 dark:text-gray-500"
                    style="font-size:66% !important;opacity:0.88;">
                    ERROR {{ $errorCode }}
                </p>
            </div>
        </div>
    </div>

    {{-- ── Debug modal ──────────────────────────────────────────── --}}

    @if ($isDebuggable)
    @include('errors::partials.modal')
    @endif
</x-webkernel::webpage>
