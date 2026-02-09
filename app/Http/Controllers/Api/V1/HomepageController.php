<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomepageResource;
use App\Http\Resources\StackResource;
use App\Http\Resources\TestimonialResource;
use App\Services\HomepageService;
use Illuminate\Http\JsonResponse;

/**
 * Controller for homepage API endpoints.
 */
class HomepageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private HomepageService $homepageService
    ) {}

    /**
     * Get the homepage data with stacks and testimonials.
     */
    public function index(): JsonResponse
    {
        $data = $this->homepageService->getHomepage();

        return response()->json([
            'data' => [
                'homepage' => new HomepageResource($data['homepage']),
                'stacks' => StackResource::collection($data['stacks']),
                'testimonials' => TestimonialResource::collection($data['testimonials']),
            ],
        ]);
    }
}
