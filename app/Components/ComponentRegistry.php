<?php

namespace App\Components;

use App\Components\Definitions\AboutComponent;
use App\Components\Definitions\BaseComponent;
use App\Components\Definitions\CtaComponent;
use App\Components\Definitions\ExperienceComponent;
use App\Components\Definitions\HeroComponent;
use App\Components\Definitions\PageIntroComponent;
use App\Components\Definitions\ServicesCtaComponent;
use App\Components\Definitions\ThisSiteComponent;

/**
 * Registry for all available component definitions.
 */
class ComponentRegistry
{
    /**
     * All registered component definition classes.
     *
     * @var array<class-string<BaseComponent>>
     */
    private static array $components = [
        HeroComponent::class,
        ExperienceComponent::class,
        AboutComponent::class,
        ThisSiteComponent::class,
        CtaComponent::class,
        PageIntroComponent::class,
        ServicesCtaComponent::class,
    ];

    /**
     * Get all registered component classes.
     *
     * @return array<class-string<BaseComponent>>
     */
    public static function all(): array
    {
        return self::$components;
    }

    /**
     * Get a component definition by name.
     *
     * @return class-string<BaseComponent>|null
     */
    public static function get(string $name): ?string
    {
        foreach (self::$components as $component) {
            if ($component::name() === $name) {
                return $component;
            }
        }

        return null;
    }

    /**
     * Get all component names.
     *
     * @return array<string>
     */
    public static function names(): array
    {
        return array_map(fn ($c) => $c::name(), self::$components);
    }

    /**
     * Get options for Filament select (name => label).
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::$components as $component) {
            $options[$component::name()] = $component::label();
        }

        return $options;
    }
}
