<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ComponentData model representing key-value data for a component.
 */
class ComponentData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'component_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'component_id',
        'key',
        'value',
    ];

    /**
     * Get the component this data belongs to.
     *
     * @return BelongsTo<Component, $this>
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }
}
