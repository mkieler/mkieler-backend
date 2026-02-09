<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service class for location-related operations.
 */
class LocationService
{
    /**
     * Get all locations ordered by sort_order.
     */
    public function getAllLocations(): Collection
    {
        return Location::query()
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get a location by slug.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getLocationBySlug(string $slug): Location
    {
        return Location::query()
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
