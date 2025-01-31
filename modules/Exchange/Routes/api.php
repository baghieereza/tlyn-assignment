<?php


use Illuminate\Support\Facades\Route;
use Modules\Exchange\Http\Controllers\OrderController;
use Modules\Exchange\Http\Controllers\TransactionController;


Route::prefix('/exchange')
    ->group(function () {

        Route::apiResource('orders' , OrderController::class);
        Route::apiResource('transactions' , TransactionController::class);
});
