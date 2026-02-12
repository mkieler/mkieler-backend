<?php

namespace App\Components\Definitions;

/**
 * Page intro section component definition.
 */
class PageIntroComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'ServicesPageIntro';
    }

    public static function label(): string
    {
        return 'Page Intro Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'title' => ['label' => 'Title', 'type' => 'text'],
            'headline' => ['label' => 'Headline', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
        ];
    }
}
