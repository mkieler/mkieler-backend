<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schema_org_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schema_org_id')->constrained('schema_org')->cascadeOnDelete();
            $table->string('key');
            $table->text('value');
            $table->timestamps();

            $table->index(['schema_org_id', 'key']);
        });

        // Migrate existing JSON data to key-value format
        $schemas = DB::table('schema_org')->get();

        foreach ($schemas as $schema) {
            $data = json_decode($schema->data, true) ?? [];

            foreach ($data as $key => $value) {
                DB::table('schema_org_data')->insert([
                    'schema_org_id' => $schema->id,
                    'key' => $key,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Remove the data column
        Schema::table('schema_org', function (Blueprint $table) {
            $table->dropColumn('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schema_org', function (Blueprint $table) {
            $table->text('data')->nullable();
        });

        // Migrate key-value data back to JSON
        $schemas = DB::table('schema_org')->get();

        foreach ($schemas as $schema) {
            $data = DB::table('schema_org_data')
                ->where('schema_org_id', $schema->id)
                ->pluck('value', 'key')
                ->toArray();

            DB::table('schema_org')
                ->where('id', $schema->id)
                ->update(['data' => json_encode($data)]);
        }

        Schema::dropIfExists('schema_org_data');
    }
};
