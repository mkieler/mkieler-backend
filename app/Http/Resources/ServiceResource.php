<?php

namespace App\Http\Resources;

use App\Config\SchemaConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource for transforming Service models.
 */
class ServiceResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'headline' => $this->headline,
            'description' => $this->description,
            'longDescription' => $this->long_description,
            'features' => $this->features,
            'technologies' => $this->technologies,
            'benefits' => $this->benefits,
            'icon' => $this->icon,
            'relatedServices' => $this->related_services,
            'useCases' => $this->use_cases,
            'seo' => $this->whenLoaded('seo', fn () => [
                'title' => $this->seo->title,
                'description' => $this->seo->description,
                'ogTitle' => $this->seo->og_title,
                'ogDescription' => $this->seo->og_description,
            ]),
            'schemaOrg' => $this->generateSchemaOrg(),
            'processes' => ServiceProcessResource::collection($this->whenLoaded('processes')),
            'faqs' => ServiceFaqResource::collection($this->whenLoaded('faqs')),
        ];
    }

    /**
     * Generate schema.org data for this service.
     *
     * @return array<string, mixed>
     */
    private function generateSchemaOrg(): array
    {
        $baseUrl = config('app.frontend_url');
        $serviceUrl = $baseUrl.'/services/'.$this->slug;

        $schemas = [
            'service' => [
                '@type' => 'Service',
                'name' => $this->title,
                'description' => $this->description,
                'url' => $serviceUrl,
                'provider' => [
                    '@type' => 'Person',
                    'name' => 'Mattias Kieler',
                ],
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'Denmark',
                ],
                'serviceType' => 'WebDevelopment',
            ],
            'breadcrumb' => SchemaConfig::breadcrumbList([
                ['name' => 'Forside', 'url' => $baseUrl],
                ['name' => 'Services', 'url' => $baseUrl.'/services'],
                ['name' => $this->title, 'url' => $serviceUrl],
            ]),
        ];

        // Add FAQPage schema if FAQs are loaded and not empty
        if ($this->relationLoaded('faqs') && $this->faqs->isNotEmpty()) {
            $schemas['faqPage'] = $this->generateFaqSchema();
        }

        return $schemas;
    }

    /**
     * Generate FAQPage schema from service FAQs.
     *
     * @return array<string, mixed>
     */
    private function generateFaqSchema(): array
    {
        $questions = [];

        foreach ($this->faqs as $faq) {
            $questions[] = [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq->answer,
                ],
            ];
        }

        return [
            '@type' => 'FAQPage',
            'mainEntity' => $questions,
        ];
    }
}
