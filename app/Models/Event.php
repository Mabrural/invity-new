<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'favicon',
        'event_name',
        'event_photo_1',
        'event_photo_2',
        'event_photo_3',
        'event_date',
        'venue',
        'event_time',
        'event_time_2',
        'link_googlemaps',
        'dresscode',
        'no_wa_confirmation',
        'other_information',
        'notes',
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}