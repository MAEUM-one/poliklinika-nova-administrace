<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    protected $table = 'mdc_orgs';
    protected $primaryKey = 'ORG_ID';
    public $timestamps = false;

    protected $fillable = [
        'ORG_SLUG', 'HOURS_ID', 'HOURS2_ID', 'NAME', 'INFO', 'ACTUAL_INFO',
        'WEB', 'NUMBER', 'EMAIL', 'POSITION', 'LOGO', 'COMPANY', 'IČZ', 'ICO', 'IMAGES'
    ];

    protected $appends = [
        'monday_m1', 'monday_m2',
        'tuesday_m1', 'tuesday_m2',
        'wednesday_m1', 'wednesday_m2',
        'thursday_m1', 'thursday_m2',
        'friday_m1', 'friday_m2',
        'saturday_m1', 'saturday_m2',
        'sunday_m1', 'sunday_m2',
        'header_m1', 'header_m2',
    ];


    public function hours(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS_ID', 'HOURS_ID');
    }

    public function hours2(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS2_ID', 'HOURS_ID');
    }

    public function hoursForDay($day = 'MON', $index = 1): Attribute
    {
        return Attribute::make(
            get: function($value) use ($day, $index) {
                $o = match ($index) {
                    2 => $this->hours2()->first(),
                    default => $this->hours()->first(),
                };
                if (!$o)
                    return 'Skrýt';
                return $o->{$day};
            },
            set: function($value) use ($day, $index) {
                $o = match ($index) {
                    2 => $this->hours2(),
                    default => $this->hours(),
                };
                if ($o->first())
                    $o->update([$day => $value]);
            }
        );
    }

    public function mondayM1(): Attribute
    {
        return $this->hoursForDay('MON', 1);
    }

    public function mondayM2(): Attribute
    {
        return $this->hoursForDay('MON', 2);
    }


    public function tuesdayM1(): Attribute
    {
        return $this->hoursForDay('TUE', 1);
    }

    public function tuesdayM2(): Attribute
    {
        return $this->hoursForDay('TUE', 2);
    }

    public function wednesdayM1(): Attribute
    {
        return $this->hoursForDay('WED', 1);
    }

    public function wednesdayM2(): Attribute
    {
        return $this->hoursForDay('WED', 2);
    }

    public function thursdayM1(): Attribute
    {
        return $this->hoursForDay('THU', 1);
    }

    public function thursdayM2(): Attribute
    {
        return $this->hoursForDay('THU', 2);
    }

    public function fridayM1(): Attribute
    {
        return $this->hoursForDay('FRI', 1);
    }

    public function fridayM2(): Attribute
    {
        return $this->hoursForDay('FRI', 2);
    }

    public function saturdayM1(): Attribute
    {
        return $this->hoursForDay('SAT', 1);
    }

    public function saturdayM2(): Attribute
    {
        return $this->hoursForDay('SAT', 2);
    }

    public function sundayM1(): Attribute
    {
        return $this->hoursForDay('SUN', 1);
    }

    public function sundayM2(): Attribute
    {
        return $this->hoursForDay('SUN', 2);
    }

    public function headerM1(): Attribute
    {
        return $this->hoursForDay('HEADER', 1);
    }

    public function headerM2(): Attribute
    {
        return $this->hoursForDay('HEADER', 2);
    }
}
