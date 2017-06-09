<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    protected static function boot()
    {
        parent::boot();
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }
}
