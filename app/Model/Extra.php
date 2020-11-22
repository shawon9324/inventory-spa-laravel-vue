<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extra';
    protected $fillable =[
        'vat','logo','store_name','phone', 'email','address'
    ];
}
