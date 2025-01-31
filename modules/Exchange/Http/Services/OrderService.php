<?php

namespace Modules\Exchange\Http\Services;

use App\Models\User;
use Modules\Exchange\Http\Services\Contracts\OrderInterface;
use Modules\Exchange\Models\Order;
use Modules\Exchange\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderInterface
{
    public function __construct(protected Order $order , protected Transaction $transaction)
    {

    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->order->query()->get();
    }
    public function matchOrder(Order $order)
    {
        // TODO: Implement matchOrder() method.
    }

    public function store($request)
    {

        return DB::transaction(function () use ($request) {
            $user = User::find($request->user_id);

            if ($request->type === Order::ORDER_TYPE_SELL && $user->gold_balance < $request->weight) {
                return response()->json(['error' => 'Insufficient gold balance'], 400);
            }

            if ($request->type === Order::ORDER_TYPE_SELL) {
                $user->decrement('gold_balance', $request->weight);
            }

            $order = Order::create([
                'user_id' => $request->user_id,
                'type' => $request->type,
                'weight' => $request->weight,
                'remaining_weight' => $request->weight,
                'price' => $request->price,
            ]);

            $this->processMatching($order);
            return response()->json($order, 201);
        });
    }

    public function update(Order $order)
    {
        // TODO: Implement update() method.
    }

    public function delete(Order $order)
    {
        // TODO: Implement delete() method.
    }

    private function processMatching(Order $order)
    {
        $oppositeType = $order->type === Order::ORDER_TYPE_BUY ? Order::ORDER_TYPE_SELL : Order::ORDER_TYPE_BUY;
        $matchingOrders = Order::where('type', $oppositeType)
            ->where('price', $order->price)
            ->where('remaining_weight', '>', 0)
            ->orderBy('created_at')
            ->get();

        foreach ($matchingOrders as $match) {
            $tradeWeight = min($order->remaining_weight, $match->remaining_weight);
            $fee = $this->calculateFee($tradeWeight, $order->price);

            $buyer = User::find($order->type === Order::ORDER_TYPE_BUY ? $order->user_id : $match->user_id);
            $seller = User::find($order->type === Order::ORDER_TYPE_SELL ? $order->user_id : $match->user_id);

            $buyer->decrement('fiat_balance', $tradeWeight * $order->price);
            $seller->increment('fiat_balance', ($tradeWeight * $order->price) - $fee);
            $buyer->increment('gold_balance', $tradeWeight);

            Transaction::query()->create([
                'buyer_id' => $buyer->id,
                'seller_id' => $seller->id,
                'weight' => $tradeWeight,
                'price' => $order->price,
                'fee' => $fee
            ]);

            $order->decrement('remaining_weight', $tradeWeight);
            $match->decrement('remaining_weight', $tradeWeight);

            if ($order->remaining_weight <= 0) break;
        }
    }

    private function calculateFee($weight, $price)
    {
        $fee = 0;
        if ($weight <= 1) {
            $fee = $weight * $price * 0.02;
        } elseif ($weight <= 10) {
            $fee = $weight * $price * 0.015;
        } else {
            $fee = $weight * $price * 0.01;
        }
        return max(50000, min($fee, 5000000));
    }


}
