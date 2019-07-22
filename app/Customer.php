<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name', 'tel', 'points', 'created_at'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
