<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Schema.org structured data model for polymorphic schema data.
 */
class SchemaOrg extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'schema_org';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'schemaable_type',
        'schemaable_id',
        'type',
    ];

    /**
     * Get the parent schemaable model.
     *
     * @return MorphTo<Model, $this>
     */
    public function schemaable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the data entries for this schema.
     *
     * @return HasMany<SchemaOrgData, $this>
     */
    public function data(): HasMany
    {
        return $this->hasMany(SchemaOrgData::class);
    }

    /**
     * Get a single value by key.
     */
    public function getValue(string $key): ?string
    {
        return $this->data->firstWhere('key', $key)?->value;
    }

    /**
     * Get all data as associative array.
     *
     * @return array<string, string>
     */
    public function getDataArray(): array
    {
        return $this->data->pluck('value', 'key')->all();
    }

    /**
     * Set a single value (replaces existing).
     */
    public function setValue(string $key, string $value): void
    {
        $this->data()->where('key', $key)->delete();
        $this->data()->create(['key' => $key, 'value' => $value]);
    }

    /**
     * Set multiple values from array.
     *
     * @param  array<string, string>  $data
     */
    public function setData(array $data): void
    {
        $this->data()->delete();

        foreach ($data as $key => $value) {
            $this->data()->create(['key' => $key, 'value' => $value]);
        }
    }
}
