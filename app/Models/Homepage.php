<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Homepage singleton model containing all homepage sections.
 */
class Homepage extends Model
{
    /** @use HasFactory<\Database\Factories\HomepageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        // SEO
        'seo_title',
        'seo_description',
        'seo_og_image',
        'seo_person_name',
        'seo_person_job_title',
        'seo_person_email',
        'seo_service_name',
        'seo_service_area_served',
        'seo_service_type',
        // Hero
        'hero_eyebrow',
        'hero_headline',
        'hero_supporting_text',
        'hero_bulletpoints',
        // Experience
        'experience_headline',
        'experience_summary',
        'experience_narrative',
        'experience_primary_metric',
        'experience_focus_areas',
        'experience_skills',
        'experience_idea_to_system',
        // About
        'about_headline',
        'about_title',
        'about_paragraphs',
        'about_image_src',
        'about_image_alt',
        // ThisSite
        'this_site_headline',
        'this_site_title',
        'this_site_description',
        'this_site_pagespeed_url',
        // CTA
        'cta_title',
        'cta_description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hero_bulletpoints' => 'array',
            'experience_focus_areas' => 'array',
            'experience_skills' => 'array',
            'experience_idea_to_system' => 'array',
            'about_paragraphs' => 'array',
        ];
    }

    /**
     * Get the singleton homepage instance, creating it if it doesn't exist.
     */
    public static function singleton(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
}
