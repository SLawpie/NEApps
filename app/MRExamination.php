<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRExamination extends Model
{
    //
    protected $fillable = [
        'name', 'reportable'
    ];

    public function prices () {
        return $this->belongsToMany('App\MRPrice');
    }
    
}
