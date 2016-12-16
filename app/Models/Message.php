<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content','note','schedule','created_by'];

    public function getStatus(){
        $sentCount = MessageUser::where('message_id',$this->id)->where('status',1)->count();
    	return $sentCount .'/'.count($this->messageUsers);
    }
    public function user(){
    	return $this->belongsTo('App\User','created_by');
    }

    public function messageUsers(){
    	return $this->hasMany('App\Models\MessageUser');
    }
}
