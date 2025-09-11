<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

class Office extends Model
{
    protected $table = 'mdc_offices';
    protected $primaryKey = 'OFFICE_ID';
    public $timestamps = false;
    protected $appends = [
        'monday_m1', 'monday_m2', 'monday_m3', 'monday_m4',
        'tuesday_m1', 'tuesday_m2', 'tuesday_m3', 'tuesday_m4',
        'wednesday_m1', 'wednesday_m2', 'wednesday_m3', 'wednesday_m4',
        'thursday_m1', 'thursday_m2', 'thursday_m3', 'thursday_m4',
        'friday_m1', 'friday_m2', 'friday_m3', 'friday_m4',
        'saturday_m1', 'saturday_m2', 'saturday_m3', 'saturday_m4',
        'sunday_m1', 'sunday_m2', 'sunday_m3', 'sunday_m4',
        'header_m1', 'header_m2', 'header_m3', 'header_m4',
    ];

    protected $fillable = [
        'OFFICE_SLUG', 'HOURS_ID', 'HOURS2_ID', 'HOURS3_ID', 'HOURS4_ID',
        'NAME', 'INFO', 'ACTUAL_INFO', 'WEB', 'NUMBER', 'EMAIL', 'POSITION',
        'ICON', 'COMPANY', 'HIDDEN'
    ];
    public function hours(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS_ID', 'HOURS_ID');
    }

    public function hours2(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS2_ID', 'HOURS_ID');
    }

    public function hours3(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS3_ID', 'HOURS_ID');
    }

    public function hours4(): BelongsTo
    {
        return $this->belongsTo(Hours::class, 'HOURS4_ID', 'HOURS_ID');
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'mdc_people_list', 'OFFICE_ID', 'PERSON_ID');
    }


    public function hoursForDay($day = 'MON', $index = 1): Attribute
    {
        return Attribute::make(
            get: function($value) use ($day, $index) {
                $o = match ($index) {
                    2 => $this->hours2()->first(),
                    3 => $this->hours3()->first(),
                    4 => $this->hours4()->first(),
                    default => $this->hours()->first(),
                };
                if (!$o)
                    return 'Skrýt';
                return $o->{$day} ?? ' ';
            },
            set: function($value) use ($day, $index) {
                $o = match ($index) {
                    2 => $this->hours2()->first(),
                    3 => $this->hours3()->first(),
                    4 => $this->hours4()->first(),
                    default => $this->hours()->first(),
                };
                if ($o) {
                    Log::debug($value . $day);
                    $o->{$day} = $value === '' ? null : $value;
                    $o->saveQuietly();
                }
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

    public function mondayM3(): Attribute
    {
        return $this->hoursForDay('MON', 3);
    }

    public function mondayM4(): Attribute
    {
        return $this->hoursForDay('MON', 4);
    }

    public function tuesdayM1(): Attribute
    {
        return $this->hoursForDay('TUE', 1);
    }

    public function tuesdayM2(): Attribute
    {
        return $this->hoursForDay('TUE', 2);
    }

    public function tuesdayM3(): Attribute
    {
        return $this->hoursForDay('TUE', 3);
    }

    public function tuesdayM4(): Attribute
    {
        return $this->hoursForDay('TUE', 4);
    }

    public function wednesdayM1(): Attribute
    {
        return $this->hoursForDay('WED', 1);
    }

    public function wednesdayM2(): Attribute
    {
        return $this->hoursForDay('WED', 2);
    }

    public function wednesdayM3(): Attribute
    {
        return $this->hoursForDay('WED', 3);
    }

    public function wednesdayM4(): Attribute
    {
        return $this->hoursForDay('WED', 4);
    }

    public function thursdayM1(): Attribute
    {
        return $this->hoursForDay('THU', 1);
    }

    public function thursdayM2(): Attribute
    {
        return $this->hoursForDay('THU', 2);
    }

    public function thursdayM3(): Attribute
    {
        return $this->hoursForDay('THU', 3);
    }

    public function thursdayM4(): Attribute
    {
        return $this->hoursForDay('THU', 4);
    }

    public function fridayM1(): Attribute
    {
        return $this->hoursForDay('FRI', 1);
    }

    public function fridayM2(): Attribute
    {
        return $this->hoursForDay('FRI', 2);
    }

    public function fridayM3(): Attribute
    {
        return $this->hoursForDay('FRI', 3);
    }

    public function fridayM4(): Attribute
    {
        return $this->hoursForDay('FRI', 4);
    }

    public function saturdayM1(): Attribute
    {
        return $this->hoursForDay('SAT', 1);
    }

    public function saturdayM2(): Attribute
    {
        return $this->hoursForDay('SAT', 2);
    }

    public function saturdayM3(): Attribute
    {
        return $this->hoursForDay('SAT', 3);
    }

    public function saturdayM4(): Attribute
    {
        return $this->hoursForDay('SAT', 4);
    }

    public function sundayM1(): Attribute
    {
        return $this->hoursForDay('SUN', 1);
    }

    public function sundayM2(): Attribute
    {
        return $this->hoursForDay('SUN', 2);
    }

    public function sundayM3(): Attribute
    {
        return $this->hoursForDay('SUN', 3);
    }

    public function sundayM4(): Attribute
    {
        return $this->hoursForDay('SUN', 4);
    }

    public function headerM1(): Attribute
    {
        return $this->hoursForDay('HEADER', 1);
    }

    public function headerM2(): Attribute
    {
        return $this->hoursForDay('HEADER', 2);
    }

    public function headerM3(): Attribute
    {
        return $this->hoursForDay('HEADER', 3);
    }

    public function headerM4(): Attribute
    {
        return $this->hoursForDay('HEADER', 4);
    }
}
