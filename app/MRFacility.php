<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRFacility extends Model
{
    //
    protected $fillable = [
        'name', 'reportable'
    ];

    public function prices () {
        return $this->belongsToMany('App\MRPrice');
    }
}
