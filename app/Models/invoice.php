<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = ['id','customer_mobile','employee_email','paid_amount','discount','payment_method_id'];

      
    public $incrementing = false;

    protected $primaryKey = 'id';
}
