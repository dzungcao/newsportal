<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['name','address','latitude','longtitude','threshold','duration','used','last_data'];

    public function getAQIStatistic(){
    	//get data in 5 hours
    	$query = \DB::select("select t.*,devices.short_label as channel from (select round(avg(value),2) as value, device_id,site_id, date_format(time, '%Y-%m-%d %H') as hour from data where site_id = ? and time > ?  GROUP BY device_id,date_format(time, '%Y-%m-%d %H')) t INNER JOIN devices on device_id = devices.id order by hour desc,channel",[$this->id,date('Y-m-d H:i:s',time() - 5*60*60)]);
    	return $query;
    }

    public function isOnline(){
    	$device = Device::where('site_id',$this->id)
    					->whereNull('parent_id')
    					->first();
    	return $device && $device->status;
    }
    public function getDeviceSerial(){
        $device = Device::where('site_id',$this->id)->first();
        if($device) return $device->serial;
        return "N/A";
    }
}
