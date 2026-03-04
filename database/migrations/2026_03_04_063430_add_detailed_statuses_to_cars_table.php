<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('parking_location')->nullable()->after('status');
            $table->string('service_status')->nullable()->after('service_notes');
        });

        // Use raw SQL to change enum columns to strings
        DB::statement("ALTER TABLE cars MODIFY nct_status VARCHAR(255) NULL");
        DB::statement("ALTER TABLE cars MODIFY radio_status VARCHAR(255) NULL");
        DB::statement("ALTER TABLE cars MODIFY valet_status VARCHAR(255) NULL");
        DB::statement("ALTER TABLE cars MODIFY paint_condition VARCHAR(255) NULL");
        DB::statement("ALTER TABLE cars MODIFY tyre_condition VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['parking_location', 'service_status']);
        });
    }
};
