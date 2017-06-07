<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

    function user(){
    	return $this->belongsTo(User::class);
    }

    function resources(){
    	return $this->belongsToMany(Resource::class);
    }

    function readableName(){
    	return str_replace('_', ' ', $this->name);
    }
}
