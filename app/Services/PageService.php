<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Service for page business logic.
 */
class PageService
{
    /**
     * Get a page by slug with all relations.
     *
     * @throws ModelNotFoundException
     */
    public function getPageBySlug(string $slug): Page
    {
        return Page::query()
            ->where('slug', $slug)
            ->with(['seo', 'author', 'components.data'])
            ->firstOrFail();
    }
}
