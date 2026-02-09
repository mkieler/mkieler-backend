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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('city');
            $table->string('suffix');
            $table->string('headline');
            $table->text('description');
            $table->text('long_description');
            $table->json('nearby_areas');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->string('seo_og_title')->nullable();
            $table->string('seo_og_description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
