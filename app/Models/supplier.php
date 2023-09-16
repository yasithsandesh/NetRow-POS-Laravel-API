<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $fillable =['mobile','fname','lname','email','company_id'];

    public $incrementing = false;

    protected $primaryKey = 'mobile';
}
