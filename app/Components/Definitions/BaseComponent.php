<?php

namespace App\Components\Definitions;

use App\Models\Component;
use Illuminate\Support\Str;

/**
 * Base class for component definitions.
 */
abstract class BaseComponent
{
    /**
     * The component name used in URLs and database.
     */
    abstract public static function name(): string;

    /**
     * Human-readable label for Filament.
     */
    abstract public static function label(): string;

    /**
     * Fields that hold a single value.
     *
     * @return array<string, array{label: string, type: string}>
     */
    public static function singleFields(): array
    {
        return [];
    }

    /**
     * Fields that can have multiple string values.
     *
     * @return array<string, array{label: string}>
     */
    public static function multipleFields(): array
    {
        return [];
    }

    /**
     * Fields that hold multiple objects (stored as JSON per item).
     *
     * @return array<string, array{label: string, fields: array<string, array{label: string, type: string}>}>
     */
    public static function repeaterFields(): array
    {
        return [];
    }

    /**
     * Transform component data to API response format.
     *
     * @return array<string, mixed>
     */
    public static function toArray(Component $component): array
    {
        $data = ['name' => $component->name];

        // Single fields - take first value
        foreach (static::singleFields() as $key => $config) {
            $data[Str::camel($key)] = $component->getValue($key);
        }

        // Multiple fields - collect all values
        foreach (static::multipleFields() as $key => $config) {
            $data[Str::camel($key)] = $component->getValues($key);
        }

        // Repeater fields - decode JSON items
        foreach (static::repeaterFields() as $key => $config) {
            $data[Str::camel($key)] = array_map(
                fn (string $json) => json_decode($json, true),
                $component->getValues($key)
            );
        }

        return $data;
    }
}
