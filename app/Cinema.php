<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = [
    	'name','seans_time','years','price','room','seans_date'
    ];
}
