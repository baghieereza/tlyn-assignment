<?php

namespace Modules\Exchange\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Exchange\Http\Services\Contracts\TransactionInterface;
use Modules\Exchange\Models\Transaction;

class TransactionController extends Controller
{
    public function __construct(protected TransactionInterface $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Transaction $order)
    {
    }

    public function store()
    {
    }

    public function update(Transaction $order)
    {
    }

    public function destroy(Transaction $order)
    {
    }

}
