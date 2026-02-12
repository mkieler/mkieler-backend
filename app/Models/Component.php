<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Component model representing a page component.
 */
class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'page_id',
        'name',
    ];

    /**
     * Get the page this component belongs to.
     *
     * @return BelongsTo<Page, $this>
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the data entries for this component.
     *
     * @return HasMany<ComponentData, $this>
     */
    public function data(): HasMany
    {
        return $this->hasMany(ComponentData::class);
    }

    /**
     * Get a single value by key.
     */
    public function getValue(string $key): ?string
    {
        return $this->data->firstWhere('key', $key)?->value;
    }

    /**
     * Get all values for a key (for multi-value fields like bullets).
     *
     * @return array<int, string>
     */
    public function getValues(string $key): array
    {
        return $this->data->where('key', $key)->pluck('value')->all();
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
     * Set multiple values for a key (replaces existing).
     *
     * @param  array<int, string>  $values
     */
    public function setValues(string $key, array $values): void
    {
        $this->data()->where('key', $key)->delete();

        foreach ($values as $value) {
            $this->data()->create(['key' => $key, 'value' => $value]);
        }
    }
}
