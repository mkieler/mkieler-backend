<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Services\TestimonialService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Controller for testimonial API endpoints.
 */
class TestimonialController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private TestimonialService $testimonialService
    ) {}

    /**
     * Get all testimonials.
     */
    public function index(): AnonymousResourceCollection
    {
        return TestimonialResource::collection(
            $this->testimonialService->getAllTestimonials()
        );
    }
}
