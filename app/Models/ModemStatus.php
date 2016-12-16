<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModemStatus extends Model
{
    public $table = 'modem_statuses';
    protected $fillable = ['type','name','message'];
}
