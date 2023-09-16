<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grn extends Model
{
    use HasFactory;

    protected $fillable =['id','supplier_mobile','employee_email','paid_amount'];

    
    public $incrementing = false;

    protected $primaryKey = 'id';
}
