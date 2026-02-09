<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'headline' => $this->headline,
            'description' => $this->description,
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'og_title' => $this->seo_og_title,
                'og_description' => $this->seo_og_description,
            ],
            'cta' => [
                'text' => $this->cta_text,
                'button_label' => $this->cta_button_label,
            ],
        ];
    }
}
