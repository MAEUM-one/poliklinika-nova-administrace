<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    protected $table = 'mdc_hours';
    protected $primaryKey = 'HOURS_ID';
    public $timestamps = false;

    protected $fillable = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN', 'HEADER'];
}
