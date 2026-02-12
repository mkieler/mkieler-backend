<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Key-value data for SchemaOrg entries.
 */
class SchemaOrgData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'schema_org_id',
        'key',
        'value',
    ];

    /**
     * Get the schema this data belongs to.
     *
     * @return BelongsTo<SchemaOrg, $this>
     */
    public function schemaOrg(): BelongsTo
    {
        return $this->belongsTo(SchemaOrg::class);
    }
}
