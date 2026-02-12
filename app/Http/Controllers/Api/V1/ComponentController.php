<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComponentResource;
use App\Services\ComponentService;

/**
 * Controller for component API endpoints.
 */
class ComponentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private ComponentService $componentService
    ) {}

    /**
     * Get a component by name.
     */
    public function show(string $name): ComponentResource
    {
        return new ComponentResource(
            $this->componentService->getComponentByName($name)
        );
    }
}
