<?php

namespace App\Components\Definitions;

/**
 * CTA section component definition.
 */
class CtaComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'FrontpageCta';
    }

    public static function label(): string
    {
        return 'CTA Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'title' => ['label' => 'Title', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
            'button_label' => ['label' => 'Button Label', 'type' => 'text'],
            'button_url' => ['label' => 'Button URL', 'type' => 'url'],
        ];
    }
}
