<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRPrice extends Model
{
	//
	protected $fillable = [
        'examination_id', 'facility_id', 'price', 'description'
    ];

	public function examination() 
	{
		return $this->belongsTo('App\MRExamination');
    }
    
    public function facility() 
	{
		return $this->belongsTo('App\MRFacility');
	}
}
