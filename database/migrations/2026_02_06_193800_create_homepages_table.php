<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();

            // SEO
            $table->string('seo_title');
            $table->text('seo_description');
            $table->string('seo_og_image')->nullable();
            $table->string('seo_person_name');
            $table->string('seo_person_job_title');
            $table->string('seo_person_email');
            $table->string('seo_service_name');
            $table->string('seo_service_area_served');
            $table->string('seo_service_type');

            // Hero
            $table->string('hero_eyebrow');
            $table->string('hero_headline');
            $table->text('hero_supporting_text');
            $table->json('hero_bulletpoints');

            // Experience
            $table->string('experience_headline');
            $table->text('experience_summary');
            $table->text('experience_narrative');
            $table->string('experience_primary_metric');
            $table->json('experience_focus_areas');
            $table->json('experience_skills');
            $table->json('experience_idea_to_system');

            // About
            $table->string('about_headline');
            $table->string('about_title');
            $table->json('about_paragraphs');
            $table->string('about_image_src')->nullable();
            $table->string('about_image_alt')->nullable();

            // ThisSite
            $table->string('this_site_headline');
            $table->string('this_site_title');
            $table->text('this_site_description');
            $table->string('this_site_pagespeed_url')->nullable();

            // CTA
            $table->string('cta_title');
            $table->text('cta_description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepages');
    }
};
