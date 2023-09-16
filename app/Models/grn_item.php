<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grn_item extends Model
{
    use HasFactory;

    protected $fillable =['stock_id','qty','buying_price','grn_id'];
    
}
