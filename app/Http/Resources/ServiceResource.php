<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
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
            'long_description' => $this->long_description,
            'features' => $this->features,
            'technologies' => $this->technologies,
            'benefits' => $this->benefits,
            'icon' => $this->icon,
            'related_services' => $this->related_services,
            'use_cases' => $this->use_cases,
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'og_title' => $this->seo_og_title,
                'og_description' => $this->seo_og_description,
            ],
            'processes' => ServiceProcessResource::collection($this->whenLoaded('processes')),
            'faqs' => ServiceFaqResource::collection($this->whenLoaded('faqs')),
        ];
    }
}
