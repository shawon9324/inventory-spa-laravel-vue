<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pointofsell extends Model
{ 
    protected $table = 'point_of_sells';
    protected $fillable =[
        'pro_id','pro_name','pro_qty','pro_price', 'sub_total',
    ];
}
