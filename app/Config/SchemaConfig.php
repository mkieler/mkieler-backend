<?php

namespace App\Config;

/**
 * Global schema.org configuration.
 */
class SchemaConfig
{
    /**
     * Get the Person schema for the site owner.
     *
     * @return array<string, mixed>
     */
    public static function person(): array
    {
        return [
            '@type' => 'Person',
            'name' => 'Mattias Kieler',
            'jobTitle' => 'Fractional CTO og senior fullstack-udvikler',
            'email' => 'hello@mkieler.dev',
            'url' => config('app.frontend_url'),
            'sameAs' => [
                'https://www.linkedin.com/in/mkieler/',
                'https://github.com/mkieler',
            ],
        ];
    }

    /**
     * Get the LocalBusiness schema.
     *
     * @return array<string, mixed>
     */
    public static function localBusiness(): array
    {
        return [
            '@type' => 'LocalBusiness',
            'name' => 'Mattias Kieler',
            'description' => 'Freelance fullstack-webudvikling med Laravel og Nuxt',
            'url' => config('app.frontend_url'),
            'areaServed' => 'Denmark',
            'priceRange' => '$$',
        ];
    }

    /**
     * Get the ProfessionalService schema.
     *
     * @return array<string, mixed>
     */
    public static function professionalService(): array
    {
        return [
            '@type' => 'ProfessionalService',
            'name' => 'Mattias Kieler',
            'description' => 'Freelance fullstack-webudvikling med Laravel og Nuxt',
            'url' => config('app.frontend_url'),
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Denmark',
            ],
            'serviceType' => 'Web Development',
            'provider' => self::person(),
        ];
    }

    /**
     * Get the WebSite schema.
     *
     * @return array<string, mixed>
     */
    public static function webSite(): array
    {
        return [
            '@type' => 'WebSite',
            'name' => 'Mattias Kieler',
            'url' => config('app.frontend_url'),
            'publisher' => self::person(),
        ];
    }

    /**
     * Get the site navigation schema.
     *
     * @return array<string, mixed>
     */
    public static function siteNavigationElement(): array
    {
        $baseUrl = config('app.frontend_url');

        return [
            '@type' => 'SiteNavigationElement',
            'name' => 'Main Navigation',
            'hasPart' => [
                [
                    '@type' => 'SiteNavigationElement',
                    'name' => 'Forside',
                    'url' => $baseUrl,
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'name' => 'Services',
                    'url' => $baseUrl.'/services',
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'name' => 'Om mig',
                    'url' => $baseUrl.'/about',
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'name' => 'Kontakt',
                    'url' => $baseUrl.'/contact',
                ],
            ],
        ];
    }

    /**
     * Generate breadcrumb schema for a page path.
     *
     * @param  array<int, array{name: string, url: string}>  $items
     * @return array<string, mixed>
     */
    public static function breadcrumbList(array $items): array
    {
        $listItems = [];
        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }

    /**
     * Get the ContactPage schema.
     *
     * @return array<string, mixed>
     */
    public static function contactPage(): array
    {
        return [
            '@type' => 'ContactPage',
            'name' => 'Kontakt',
            'description' => 'Kontakt Mattias Kieler for en uforpligtende snak om dit projekt.',
            'url' => config('app.frontend_url').'/contact',
            'mainEntity' => self::person(),
        ];
    }

    /**
     * Get all global schema data.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function global(): array
    {
        return [
            'person' => self::person(),
            'localBusiness' => self::localBusiness(),
            'professionalService' => self::professionalService(),
            'webSite' => self::webSite(),
            'siteNavigationElement' => self::siteNavigationElement(),
        ];
    }
}
