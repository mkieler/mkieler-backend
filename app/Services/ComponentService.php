<?php

namespace App\Services;

use App\Models\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Service for component business logic.
 */
class ComponentService
{
    /**
     * Get a component by name (case-insensitive).
     *
     * @throws ModelNotFoundException
     */
    public function getComponentByName(string $name): Component
    {
        return Component::with('data')
            ->whereRaw('LOWER(name) = ?', [strtolower($name)])
            ->firstOrFail();
    }
}
