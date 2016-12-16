<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	public $timestamps = false;
    public static function get($key,$default){
    	$config = Config::where('key',$key)->first();
    	if(!$config){
    		$config = new Config();
    		$config->key = $key;
    		$config->value = $default;
    		$config->save();
    	}
    	return $config->value;
    }
    public function set($key,$value){
        $config = Config::where('key',$key)->first();
        $config->value = $value;
        $config->save();
    }
}
