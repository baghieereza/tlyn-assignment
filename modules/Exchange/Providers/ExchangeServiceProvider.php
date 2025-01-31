<?php
namespace Modules\Exchange\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Exchange\Http\Services\Contracts\OrderInterface;
use Modules\Exchange\Http\Services\Contracts\TransactionInterface;
use Modules\Exchange\Http\Services\OrderService;
use Modules\Exchange\Http\Services\TransactionService;

class ExchangeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(OrderInterface::class,OrderService::class);
        $this->app->bind(TransactionInterface::class,TransactionService::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
