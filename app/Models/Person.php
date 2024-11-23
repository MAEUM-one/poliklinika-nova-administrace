<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'mdc_people';
    protected $primaryKey = 'PERSON_ID';
    public $timestamps = false;

    protected $appends = [
        'full_name'
    ];
    protected $fillable = [
        'NAME', 'SURNAME', 'TITLE', 'FJID', 'POSITION', 'EMAIL',
        'PHONE', 'CELL', 'WEB', 'QUALIFICATION'
    ];

    public function fullName(): Attribute {
        return Attribute::make(
            get: function ($value) {
                return "{$this->NAME} {$this->SURNAME} ({$this->POSITION})";
            }
        );
    }

    public function offices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Office::class, 'mdc_people_list', 'PERSON_ID', 'OFFICE_ID');
    }
}
