<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Helper untuk mendeteksi apakah file adalah URL external atau storage path
        Blade::directive('fileUrl', function ($expression) {
            return "<?php echo (filter_var($expression, FILTER_VALIDATE_URL) ? $expression : Storage::url($expression)); ?>";
        });
    }

    /**
     * Helper function untuk mendapatkan URL file (external atau storage)
     */
    public static function getFileUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }
        
        // Jika sudah berupa URL (http/https), kembalikan langsung
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }
        
        // Jika path storage, gunakan Storage::url
        return Storage::url($path);
    }
}
