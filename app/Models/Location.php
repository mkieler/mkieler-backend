<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Location model representing a geographic service location.
 */
class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'city',
        'suffix',
        'headline',
        'description',
        'long_description',
        'nearby_areas',
        'seo_title',
        'seo_description',
        'seo_og_title',
        'seo_og_description',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nearby_areas' => 'array',
        ];
    }
}
