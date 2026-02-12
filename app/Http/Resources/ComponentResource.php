<?php

namespace App\Http\Resources;

use App\Components\ComponentRegistry;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * Resource for transforming Component models.
 */
class ComponentResource extends JsonResource
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
        $definition = ComponentRegistry::get($this->name);

        if ($definition) {
            return $definition::toArray($this->resource);
        }

        return $this->transformRaw();
    }

    /**
     * Transform component to raw key-value structure.
     *
     * @return array<string, mixed>
     */
    private function transformRaw(): array
    {
        $data = ['name' => $this->name];

        $grouped = $this->data->groupBy('key');

        foreach ($grouped as $key => $items) {
            $data[Str::camel($key)] = $items->count() === 1
                ? $items->first()->value
                : $items->pluck('value')->all();
        }

        return $data;
    }
}
