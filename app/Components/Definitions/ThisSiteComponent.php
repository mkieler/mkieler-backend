<?php

namespace App\Components\Definitions;

/**
 * This Site section component definition.
 */
class ThisSiteComponent extends BaseComponent
{
    public static function name(): string
    {
        return 'FrontpageThisSite';
    }

    public static function label(): string
    {
        return 'This Site Sektion';
    }

    public static function singleFields(): array
    {
        return [
            'headline' => ['label' => 'Headline', 'type' => 'text'],
            'title' => ['label' => 'Title', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
            'pagespeed_url' => ['label' => 'PageSpeed URL', 'type' => 'url'],
        ];
    }
}
