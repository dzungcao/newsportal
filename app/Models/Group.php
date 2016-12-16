<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','order','note'];

    public function users(){
        return $this->hasMany('App\Models\UserGroup','group_id');
    }
}
