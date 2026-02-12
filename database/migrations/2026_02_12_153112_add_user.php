<?php

use App\Models\User;
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
        User::firstOrCreate(
            ['email' => 'mattias@mkieler.com'],
            [
                'name' => 'Mattias Kieler',
                'password' => bcrypt('securepassword123'),
                'is_admin' => true,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', 'mattias@mkieler.com')->delete();
    }
};
