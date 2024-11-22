<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PersonOffice extends Pivot
{
    protected $table = 'mdc_people_list';
    public $timestamps = false;

    protected $fillable = ['PERSON_ID', 'OFFICE_ID'];
}
