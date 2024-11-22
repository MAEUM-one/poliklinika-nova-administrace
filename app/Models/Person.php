<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'mdc_people';
    protected $primaryKey = 'PERSON_ID';
    public $timestamps = false;

    protected $fillable = [
        'NAME', 'SURNAME', 'TITLE', 'FJID', 'POSITION', 'EMAIL',
        'PHONE', 'CELL', 'WEB', 'QUALIFICATION'
    ];

    public function offices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Office::class, 'mdc_people_list', 'PERSON_ID', 'OFFICE_ID');
    }
}
