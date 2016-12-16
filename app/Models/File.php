<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $fillable = ['name','type','visibility','path','download','created_by'];

    public function author(){
    	return $this->belongsTo('App\User','created_by');
    }
}
