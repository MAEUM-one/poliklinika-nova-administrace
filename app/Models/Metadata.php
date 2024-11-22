<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metadata extends Model
{
    protected $table = 'fj_hermes_metadata';
    protected $primaryKey = 'MESSAGE_MTDT_ID';
    public $timestamps = false;
    protected $appends = ['header'];

    protected $fillable = ['IMAGE', 'AUTHOR', 'SLUG', 'DATE', 'IMAGES', 'IMAGES_CAPTION'];

    public function header(): Attribute {
        return Attribute::make(
             get: function() {
                 return $this->content()->first()?->HEADER ?? 'Smazaný článek';
            }
        );
    }

    public function content(): HasMany {
        return $this->hasMany(Content::class, 'SLUG', 'SLUG');
    }
}
