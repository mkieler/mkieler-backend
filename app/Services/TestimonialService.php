<?php

namespace App\Services;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service for testimonial business logic.
 */
class TestimonialService
{
    /**
     * Get all testimonials with author.
     *
     * @return Collection<int, Testimonial>
     */
    public function getAllTestimonials(): Collection
    {
        return Testimonial::query()
            ->with(['author'])
            ->orderBy('sort_order')
            ->get();
    }
}
