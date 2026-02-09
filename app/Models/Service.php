<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Service model representing a service offering.
 */
class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'title',
        'headline',
        'description',
        'long_description',
        'features',
        'technologies',
        'benefits',
        'icon',
        'related_services',
        'use_cases',
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
            'features' => 'array',
            'technologies' => 'array',
            'benefits' => 'array',
            'related_services' => 'array',
            'use_cases' => 'array',
        ];
    }

    /**
     * Get the process steps for this service.
     *
     * @return HasMany<ServiceProcess, $this>
     */
    public function processes(): HasMany
    {
        return $this->hasMany(ServiceProcess::class)->orderBy('step');
    }

    /**
     * Get the FAQs for this service.
     *
     * @return HasMany<ServiceFaq, $this>
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
    }
}
