<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServicesPage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service class for service-related operations.
 */
class ServiceService
{
    /**
     * Get all services ordered by sort_order.
     */
    public function getAllServices(): Collection
    {
        return Service::query()
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get a service by slug with processes and FAQs.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getServiceBySlug(string $slug): Service
    {
        return Service::query()
            ->where('slug', $slug)
            ->with(['processes', 'faqs'])
            ->firstOrFail();
    }

    /**
     * Get the services overview page.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getServicesPage(): ServicesPage
    {
        return ServicesPage::query()->firstOrFail();
    }
}
