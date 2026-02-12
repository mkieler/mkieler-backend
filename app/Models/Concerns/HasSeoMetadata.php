<?php

namespace App\Models\Concerns;

use App\Models\SeoMetadata;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait for models that have SEO metadata.
 */
trait HasSeoMetadata
{
    /**
     * Get the SEO metadata for this model.
     *
     * @return MorphOne<SeoMetadata, $this>
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }
}
