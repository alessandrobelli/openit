<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'latitude', 'longitude', 'crit', 'notes', 'disability_type_id'];

    /**
     * The places that belong to the pin.
     */
    public function mapRoutes()
    {
        return $this->belongsToMany('App\MapRoute');
    }

    /**
     * The places that belong to the pin.
     */
    public function disabilityType()
    {
        return $this->belongsTo('App\DisabilityType');
    }


}
