<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageUser extends Model
{
    protected $fillable = ['message_id','user_id','attempt','status','schedule'];
    public function message(){
        return $this->belongsTo('App\Models\Message');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function getStatus(){
    	switch ($this->status) {
    		case 0:
    			return 'Chưa gửi';
    		case -1:
    			return 'Hủy gửi';
    		case 1:
    			return 'Đã gửi';
    	}
    }
}
