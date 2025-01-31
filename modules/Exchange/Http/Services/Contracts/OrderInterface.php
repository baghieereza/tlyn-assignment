<?php

namespace Modules\Exchange\Http\Services\Contracts;

use Illuminate\Http\Request;
use Modules\Exchange\Models\Order;

interface OrderInterface
{

    public function store(Request $request);
    public function matchOrder(Order $order);
    public function update(Order $order);
    public function delete(Order $order);


}
