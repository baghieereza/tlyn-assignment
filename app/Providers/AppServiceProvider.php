<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

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
        $modulesPath = config('modules.path');
        if (File::exists($modulesPath)) {
            $modules = File::directories($modulesPath);
            foreach ($modules as $module) {
                $providerClass = 'Modules\\' . basename($module) . '\\Providers\\' . basename($module) . 'ServiceProvider';
                if (class_exists($providerClass)) {
                    $this->app->register($providerClass);
                }
            }
        }
    }
}
