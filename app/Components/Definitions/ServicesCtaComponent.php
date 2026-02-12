<?php

namespace App\Components\Definitions;

/**
 * Services page CTA component definition.
 */
class ServicesCtaComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'ServicesCta';
    }

    public static function label(): string
    {
        return 'Services CTA';
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
