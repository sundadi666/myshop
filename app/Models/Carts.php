<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    public function sizedata()
    {
    	return $this->belongsTo('App\Models\Sizes','sid');
    }

    public function modelsdata()
    {
    	return $this->belongsTo('App\Models\Models','mid');
    }

}
