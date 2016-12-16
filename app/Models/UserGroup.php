<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $fillable = ['user_id','group_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function group(){
        return $this->belongsTo('App\Models\Group','group_id');
    }
}
