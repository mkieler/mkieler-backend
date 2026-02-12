<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Services\PageService;

/**
 * Controller for page API endpoints.
 */
class PageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private PageService $pageService
    ) {}

    /**
     * Get a page by slug.
     */
    public function show(string $slug): PageResource
    {
        return new PageResource(
            $this->pageService->getPageBySlug($slug)
        );
    }
}
