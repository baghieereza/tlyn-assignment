<?php

namespace Modules\Exchange\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Exchange\Http\Requests\OrderStoreRequest;
use Modules\Exchange\Http\Services\Contracts\OrderInterface;
use Modules\Exchange\Models\Order;

class OrderController extends Controller
{

    public function __construct(protected OrderInterface $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function store(OrderStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(Order $order)
    {
    }

    public function destroy(Order $order)
    {
    }


}
