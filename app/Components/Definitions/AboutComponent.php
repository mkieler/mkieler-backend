<?php

namespace App\Components\Definitions;

/**
 * About section component definition.
 */
class AboutComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'FrontpageAbout';
    }

    public static function label(): string
    {
        return 'About Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'headline' => ['label' => 'Headline', 'type' => 'text'],
            'title' => ['label' => 'Title', 'type' => 'text'],
            'image_src' => ['label' => 'Image Source', 'type' => 'text'],
            'image_alt' => ['label' => 'Image Alt', 'type' => 'text'],
        ];
    }

    public static function multipleFields(): array
    {
        return [
            'paragraph' => ['label' => 'Paragraphs'],
        ];
    }
}
