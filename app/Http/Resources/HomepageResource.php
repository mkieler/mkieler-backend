<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomepageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'seo' => [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'og_title' => $this->seo_og_title,
                'og_description' => $this->seo_og_description,
            ],
            'hero' => [
                'badge' => $this->hero_badge,
                'headline' => $this->hero_headline,
                'sub_headline' => $this->hero_sub_headline,
                'primary_cta_label' => $this->hero_primary_cta_label,
                'primary_cta_link' => $this->hero_primary_cta_link,
                'secondary_cta_label' => $this->hero_secondary_cta_label,
                'secondary_cta_link' => $this->hero_secondary_cta_link,
            ],
            'experience' => [
                'badge' => $this->experience_badge,
                'headline' => $this->experience_headline,
                'description' => $this->experience_description,
                'years' => $this->experience_years,
                'projects' => $this->experience_projects,
            ],
            'about' => [
                'badge' => $this->about_badge,
                'headline' => $this->about_headline,
                'paragraphs' => $this->about_paragraphs,
            ],
            'this_site' => [
                'badge' => $this->this_site_badge,
                'headline' => $this->this_site_headline,
                'description' => $this->this_site_description,
                'bullets' => $this->this_site_bullets,
            ],
            'cta' => [
                'badge' => $this->cta_badge,
                'headline' => $this->cta_headline,
                'description' => $this->cta_description,
                'primary_cta_label' => $this->cta_primary_cta_label,
                'primary_cta_link' => $this->cta_primary_cta_link,
            ],
        ];
    }
}
