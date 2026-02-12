<?php

namespace App\Http\Resources;

use App\Components\ComponentRegistry;
use App\Config\SchemaConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * Resource for transforming Page models.
 */
class PageResource extends JsonResource
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
            'name' => $this->name,
            'author' => $this->whenLoaded('author', fn () => [
                'name' => $this->author->name,
                'jobTitle' => $this->author->job_title,
                'image' => $this->author->image,
            ]),
            'seo' => $this->whenLoaded('seo', fn () => [
                'title' => $this->seo->title,
                'description' => $this->seo->description,
                'ogTitle' => $this->seo->og_title,
                'ogDescription' => $this->seo->og_description,
                'ogImage' => $this->seo->og_image,
            ]),
            'schemaOrg' => $this->generateSchemaOrg(),
            'components' => $this->whenLoaded('components', fn () => $this->transformComponents()),
        ];
    }

    /**
     * Generate schema.org data for this page.
     *
     * @return array<string, mixed>
     */
    private function generateSchemaOrg(): array
    {
        $seo = $this->relationLoaded('seo') ? $this->seo : null;
        $baseUrl = config('app.frontend_url');
        $pageUrl = $this->slug === 'home' ? $baseUrl : $baseUrl.'/'.$this->slug;

        return [
            'global' => SchemaConfig::global(),
            'page' => [
                '@type' => 'WebPage',
                'name' => $seo?->title ?? $this->name,
                'description' => $seo?->description,
                'url' => $pageUrl,
            ],
            'breadcrumb' => $this->generateBreadcrumb($baseUrl, $pageUrl),
        ];
    }

    /**
     * Generate breadcrumb schema for this page.
     *
     * @return array<string, mixed>
     */
    private function generateBreadcrumb(string $baseUrl, string $pageUrl): array
    {
        $items = [['name' => 'Forside', 'url' => $baseUrl]];

        if ($this->slug !== 'home') {
            $items[] = ['name' => $this->name, 'url' => $pageUrl];
        }

        return SchemaConfig::breadcrumbList($items);
    }

    /**
     * Transform components to keyed array format.
     *
     * @return array<string, mixed>
     */
    private function transformComponents(): array
    {
        $components = [];

        foreach ($this->components as $component) {
            $definition = ComponentRegistry::get($component->name);

            if ($definition) {
                $components[$component->name] = $definition::toArray($component);
            } else {
                // Fallback for undefined components
                $data = ['name' => $component->name];
                $grouped = $component->data->groupBy('key');

                foreach ($grouped as $key => $items) {
                    $data[Str::camel($key)] = $items->count() === 1
                        ? $items->first()->value
                        : $items->pluck('value')->all();
                }

                $components[$component->name] = $data;
            }
        }

        return $components;
    }
}
