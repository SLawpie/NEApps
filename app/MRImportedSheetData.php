<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRImportedSheetData extends Model
{
    public $timestamps = false;

    //

    protected $fillable = [
        'col0', 'col1' , 'col2', 'col3', 'col4'
    ];
}
