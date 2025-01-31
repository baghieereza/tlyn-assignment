<?php

namespace Modules\Exchange\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ORDER_TYPE_BUY='buy';
    const ORDER_TYPE_SELL='sell';

    protected $fillable = ['user_id', 'type', 'weight', 'remaining_weight', 'price'];

}
