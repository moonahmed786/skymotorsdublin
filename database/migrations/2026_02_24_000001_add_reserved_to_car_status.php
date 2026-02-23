<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL, we can change the enum by modifying the column
        DB::statement("ALTER TABLE cars MODIFY COLUMN status ENUM('available', 'sold', 'in_service', 'reserved') DEFAULT 'available'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE cars MODIFY COLUMN status ENUM('available', 'sold', 'in_service') DEFAULT 'available'");
    }
};
