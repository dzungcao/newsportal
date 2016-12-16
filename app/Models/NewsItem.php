<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    public $fillable = ['title','published','published_date','content','author_id','picture'];

    public function getSlug(){
    	return $this->id . '/' . str_slug($this->title, '-');
    }

    public function author(){
    	return $this->belongsTo('App\User','author_id');
    }
}
