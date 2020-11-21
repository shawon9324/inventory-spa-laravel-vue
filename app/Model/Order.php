<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable =[
        'customer_id','qty','sub_total','vat','total','pay','due','payby','order_date','order_month','order_year'
    ];
    public function customer(){
        return $this->belongsTo('App\Model\Customer','customer_id')->select('name','id');
    }
}
