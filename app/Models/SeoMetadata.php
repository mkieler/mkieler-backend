<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * SEO metadata model for polymorphic SEO data.
 */
class SeoMetadata extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'seo_metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'title',
        'description',
        'og_title',
        'og_description',
        'og_image',
    ];

    /**
     * Get the parent seoable model.
     *
     * @return MorphTo<Model, $this>
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
