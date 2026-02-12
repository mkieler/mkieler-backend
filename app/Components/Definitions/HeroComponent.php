<?php

namespace App\Components\Definitions;

/**
 * Hero section component definition.
 */
class HeroComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'FrontpageHero';
    }

    public static function label(): string
    {
        return 'Hero Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'eyebrow' => ['label' => 'Eyebrow', 'type' => 'text'],
            'headline' => ['label' => 'Headline', 'type' => 'text'],
            'supporting_text' => ['label' => 'Supporting Text', 'type' => 'textarea'],
        ];
    }

    public static function repeaterFields(): array
    {
        return [
            'bulletpoint' => [
                'label' => 'Bulletpoints',
                'fields' => [
                    'title' => ['label' => 'Title', 'type' => 'text'],
                    'description' => ['label' => 'Description', 'type' => 'text'],
                    'icon' => ['label' => 'Icon', 'type' => 'text'],
                ],
            ],
        ];
    }
}
