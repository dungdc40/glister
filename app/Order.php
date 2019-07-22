<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['price', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
