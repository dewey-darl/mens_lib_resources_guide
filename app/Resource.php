<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $fillable = ['name', 'url', 'description', 'is_published'];

    function user(){
    	return $this->belongsTo(User::class);
    }

    function tags(){
    	return $this->belongsToMany(Tag::class);
    }

    static function published(){
    	return self::where('is_published', true);
    }

    static function unpublished(){
        return self::where('is_published', false);
    }
}
