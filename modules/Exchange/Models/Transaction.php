<?php

namespace Modules\Exchange\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ["buyer_id" , "seller_id","weight","price","fee"];
}
