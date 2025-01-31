<?php

namespace Modules\Exchange\Http\Services;

use Illuminate\Http\Request;
use Modules\Exchange\Http\Services\Contracts\TransactionInterface;
use Modules\Exchange\Models\Transaction;

class TransactionService implements TransactionInterface
{


    public function __construct(protected Transaction $transaction)
    {
    }

    public function index()
    {
        $transactions = $this->transaction->query()->with(['buyer', 'seller'])->get();
        return response()->json($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function update(Transaction $transaction , Request $request)
    {
        // TODO: Implement update() method.
    }

    public function delete(Transaction $transaction)
    {
        return $transaction->delete();
    }
}
