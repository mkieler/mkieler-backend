<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ServicesPage singleton model for the services overview page.
 */
class ServicesPage extends Model
{
    /** @use HasFactory<\Database\Factories\ServicesPageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'headline',
        'description',
        'seo_title',
        'seo_description',
        'seo_og_title',
        'seo_og_description',
        'cta_text',
        'cta_button_label',
    ];

    /**
     * Get the singleton services page instance, creating it if it doesn't exist.
     */
    public static function singleton(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
}
