<?php

namespace App\Components\Definitions;

/**
 * Experience section component definition.
 */
class ExperienceComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'FrontpageExperience';
    }

    public static function label(): string
    {
        return 'Experience Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'headline' => ['label' => 'Headline', 'type' => 'text'],
            'summary' => ['label' => 'Summary', 'type' => 'textarea'],
            'narrative' => ['label' => 'Narrative', 'type' => 'textarea'],
            'primary_metric' => ['label' => 'Primary Metric', 'type' => 'text'],
        ];
    }

    public static function multipleFields(): array
    {
        return [
            'focus_area' => ['label' => 'Focus Areas'],
            'skill' => ['label' => 'Skills'],
            'quote' => ['label' => 'Quotes'],
        ];
    }
}
