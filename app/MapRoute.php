<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapRoute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'active'];

    /**
     * The places that belong to the pin.
     */
    public function places()
    {
        return $this->belongsToMany('App\Place');
    }

    /**
     * The places that belong to the pin.
     */
    public function pins()
    {
        return $this->belongsToMany('App\Pin');
    }
}
