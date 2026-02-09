<?php

namespace App\Services;

use App\Models\Homepage;
use App\Models\Stack;
use App\Models\Testimonial;

/**
 * Service class for homepage-related operations.
 */
class HomepageService
{
    /**
     * Get the homepage data with stacks and testimonials.
     */
    public function getHomepage(): array
    {
        $homepage = Homepage::query()->first();

        return [
            'homepage' => $homepage,
            'stacks' => Stack::query()->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::query()->orderBy('sort_order')->get(),
        ];
    }
}
