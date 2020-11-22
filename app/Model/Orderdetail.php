<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'order_details';
    protected $fillable =[
        'order_id','product_id','pro_qty','pro_price', 'sub_total'
    ];
    
}