<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource for transforming Testimonial models.
 */
class TestimonialResource extends JsonResource
{
    /**
     * Disable data wrapping.
     *
     * @var string|null
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quote' => $this->quote,
            'author' => $this->whenLoaded('author', fn () => [
                'name' => $this->author->name,
                'jobTitle' => $this->author->job_title,
                'company' => $this->author->company,
                'image' => $this->author->image,
            ]),
            'schemaOrg' => $this->generateSchemaOrg(),
        ];
    }

    /**
     * Generate schema.org Review data for this testimonial.
     *
     * @return array<int, array{type: string, data: array<string, mixed>}>
     */
    private function generateSchemaOrg(): array
    {
        $author = $this->relationLoaded('author') ? $this->author : null;

        return [
            [
                'type' => 'Review',
                'data' => [
                    '@type' => 'Review',
                    'reviewBody' => $this->quote,
                    'author' => $author ? [
                        '@type' => 'Person',
                        'name' => $author->name,
                        'jobTitle' => $author->job_title,
                    ] : null,
                    'itemReviewed' => [
                        '@type' => 'LocalBusiness',
                        'name' => 'Mattias Kieler',
                    ],
                ],
            ],
        ];
    }
}
