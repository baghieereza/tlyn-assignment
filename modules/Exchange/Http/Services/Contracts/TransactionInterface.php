<?php

namespace Modules\Exchange\Http\Services\Contracts;

use Illuminate\Http\Request;
use Modules\Exchange\Models\Transaction;

interface TransactionInterface
{
    public function index();
    public function show(Transaction $transaction);
    public function store(Request $request);
    public function update(Transaction $transaction, Request $request);
    public function delete(Transaction $transaction);

}
