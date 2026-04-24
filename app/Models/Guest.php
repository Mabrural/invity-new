<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'slug',
    ];

    // RELATION
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // AUTO SLUG
    protected static function booted()
    {
        static::creating(function ($guest) {
            $slug = Str::slug($guest->name);

            // HANDLE DUPLICATE SLUG
            $count = Guest::where('slug', 'LIKE', "{$slug}%")->count();
            $guest->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}