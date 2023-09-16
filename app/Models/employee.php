<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $fillable =['email','fname','lname','nic','mobile','password','gender_id','employee_id'];

    public $incrementing = false;

    protected $primaryKey = 'email';


}
