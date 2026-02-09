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
        Schema::create('services_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('headline');
            $table->text('description');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->string('seo_og_title')->nullable();
            $table->string('seo_og_description')->nullable();
            $table->text('cta_text');
            $table->string('cta_button_label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_pages');
    }
};
