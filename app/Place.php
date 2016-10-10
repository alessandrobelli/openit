<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'active'];

    /**
     * The pins that belong to the place
     */
    public function mapRoutes()
    {
        return $this->belongsToMany('App\MapRoute');
    }
}
