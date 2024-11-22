<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'fj_hermes_content';
    protected $primaryKey = 'MESSAGE_CONT_ID';
    public $timestamps = false;

    protected $fillable = ['LANG', 'HEADER', 'CONTENT', 'SLUG'];
}
