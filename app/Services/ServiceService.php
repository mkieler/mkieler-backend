<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service class for service-related operations.
 */
class ServiceService
{
    /**
     * Get all services ordered by sort_order.
     *
     * @return Collection<int, Service>
     */
    public function getAllServices(): Collection
    {
        return Service::query()
            ->with(['seo'])
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get featured services for homepage.
     *
     * @return Collection<int, Service>
     */
    public function getFeaturedServices(): Collection
    {
        return Service::query()
            ->with(['seo'])
            ->where('featured', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get a service by slug with all relations.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getServiceBySlug(string $slug): Service
    {
        return Service::query()
            ->where('slug', $slug)
            ->with(['seo', 'processes', 'faqs'])
            ->firstOrFail();
    }
}
