<?php

namespace App\Filament\Resources\Homepages\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class HomepageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Sections')
                    ->tabs([
                        Tab::make('SEO')
                            ->schema([
                                Section::make('Page SEO')
                                    ->schema([
                                        TextInput::make('seo_title')
                                            ->label('Title')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('seo_description')
                                            ->label('Description')
                                            ->required()
                                            ->rows(3),
                                        TextInput::make('seo_og_image')
                                            ->label('OG Image')
                                            ->maxLength(255),
                                    ]),
                                Section::make('Person Schema')
                                    ->schema([
                                        TextInput::make('seo_person_name')
                                            ->label('Name')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('seo_person_job_title')
                                            ->label('Job Title')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('seo_person_email')
                                            ->label('Email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->columns(3),
                                Section::make('Service Schema')
                                    ->schema([
                                        TextInput::make('seo_service_name')
                                            ->label('Service Name')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('seo_service_area_served')
                                            ->label('Area Served')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('seo_service_type')
                                            ->label('Service Type')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->columns(3),
                            ]),
                        Tab::make('Hero')
                            ->schema([
                                TextInput::make('hero_eyebrow')
                                    ->label('Eyebrow')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('hero_headline')
                                    ->label('Headline')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('hero_supporting_text')
                                    ->label('Supporting Text')
                                    ->required()
                                    ->rows(4),
                                Repeater::make('hero_bulletpoints')
                                    ->label('Bulletpoints')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('description')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('icon')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('i-lucide-rocket'),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(3),
                            ]),
                        Tab::make('Experience')
                            ->schema([
                                TextInput::make('experience_headline')
                                    ->label('Headline')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('experience_summary')
                                    ->label('Summary')
                                    ->required()
                                    ->rows(3),
                                Textarea::make('experience_narrative')
                                    ->label('Narrative')
                                    ->required()
                                    ->rows(4),
                                TextInput::make('experience_primary_metric')
                                    ->label('Primary Metric')
                                    ->required()
                                    ->maxLength(255),
                                TagsInput::make('experience_focus_areas')
                                    ->label('Focus Areas')
                                    ->required(),
                                TagsInput::make('experience_skills')
                                    ->label('Skills')
                                    ->required(),
                                Repeater::make('experience_idea_to_system')
                                    ->label('Idea to System')
                                    ->simple(
                                        Textarea::make('text')
                                            ->required()
                                            ->rows(2)
                                    )
                                    ->defaultItems(3),
                            ]),
                        Tab::make('About')
                            ->schema([
                                TextInput::make('about_headline')
                                    ->label('Headline')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('about_title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                Repeater::make('about_paragraphs')
                                    ->label('Paragraphs')
                                    ->simple(
                                        Textarea::make('paragraph')
                                            ->required()
                                            ->rows(4)
                                    )
                                    ->defaultItems(3),
                                Section::make('Image')
                                    ->schema([
                                        TextInput::make('about_image_src')
                                            ->label('Image Source')
                                            ->maxLength(255),
                                        TextInput::make('about_image_alt')
                                            ->label('Image Alt')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('This Site')
                            ->schema([
                                TextInput::make('this_site_headline')
                                    ->label('Headline')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('this_site_title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('this_site_description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(5),
                                TextInput::make('this_site_pagespeed_url')
                                    ->label('PageSpeed URL')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                        Tab::make('CTA')
                            ->schema([
                                TextInput::make('cta_title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('cta_description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(4),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
