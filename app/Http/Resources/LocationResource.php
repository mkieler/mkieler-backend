<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'city' => $this->city,
            'suffix' => $this->suffix,
            'headline' => $this->headline,
            'description' => $this->description,
            'long_description' => $this->long_description,
            'nearby_areas' => $this->nearby_areas,
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'og_title' => $this->seo_og_title,
                'og_description' => $this->seo_og_description,
            ],
        ];
    }
}
