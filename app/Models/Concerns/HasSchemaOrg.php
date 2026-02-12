<?php

namespace App\Models\Concerns;

use App\Models\SchemaOrg;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait for models that have Schema.org structured data.
 */
trait HasSchemaOrg
{
    /**
     * Get the Schema.org data for this model.
     *
     * @return MorphMany<SchemaOrg, $this>
     */
    public function schemaOrg(): MorphMany
    {
        return $this->morphMany(SchemaOrg::class, 'schemaable');
    }
}
