<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Controller for service API endpoints.
 */
class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private ServiceService $serviceService
    ) {}

    /**
     * Get all services.
     */
    public function index(): AnonymousResourceCollection
    {
        return ServiceResource::collection(
            $this->serviceService->getAllServices()
        );
    }

    /**
     * Get featured services for homepage.
     */
    public function featured(): AnonymousResourceCollection
    {
        return ServiceResource::collection(
            $this->serviceService->getFeaturedServices()
        );
    }

    /**
     * Get a specific service by slug.
     */
    public function show(string $slug): ServiceResource
    {
        return new ServiceResource(
            $this->serviceService->getServiceBySlug($slug)
        );
    }
}
