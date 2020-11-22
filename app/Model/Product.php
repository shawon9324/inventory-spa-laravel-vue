<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'category_id','supplier_id','product_code','product_name','product_image',
        'product_details','root','buying_price','selling_price','buying_date','product_quantity'
    ];
    public function category()
    {
      return $this->belongsTo('App\Model\Category', 'category_id')->select('category_name','id');
    }
    public function supplier()
    {
      return $this->belongsTo('App\Model\Supplier', 'supplier_id')->select('name','id');
    }
    public function order()
    {
      return $this->hasMany('App\Model\Orderdetail', 'product_id')->select('product_id','pro_qty');
    }

}