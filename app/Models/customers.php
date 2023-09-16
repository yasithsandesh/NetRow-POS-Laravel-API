<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    protected $fillable = ['mobile','fname','lname','email','points'];

    public $incrementing = false;

    protected $primaryKey  = 'mobile';
}
