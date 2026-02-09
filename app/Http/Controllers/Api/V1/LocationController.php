<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Controller for location API endpoints.
 */
class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private LocationService $locationService
    ) {}

    /**
     * Get all locations.
     */
    public function index(): AnonymousResourceCollection
    {
        return LocationResource::collection(
            $this->locationService->getAllLocations()
        );
    }

    /**
     * Get a specific location by slug.
     */
    public function show(string $slug): LocationResource
    {
        return new LocationResource(
            $this->locationService->getLocationBySlug($slug)
        );
    }
}
