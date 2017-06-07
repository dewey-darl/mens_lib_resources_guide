<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $fillable = ['name', 'url', 'description'];

    function user(){
    	return $this->belongsTo(User::class);
    }
}
