<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $fillable = ['name', 'url', 'description'];

    function user(){
    	return $this->belongsTo(User::class);
    }

    function tags(){
    	return $this->belongsToMany(Tag::class);
    }
}
