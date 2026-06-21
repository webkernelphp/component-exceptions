<?php declare(strict_types=1);
namespace Webkernel\Exceptions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ExceptionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Use prependNamespace instead of replace to ensure we don't break
        // Laravel's internal fallbacks if the custom folder is missing a specific file.
        View::prependNamespace('errors', [
                webkernel_package('component-exceptions', 'resources/error-pages/views')
        ]);

    }
}
