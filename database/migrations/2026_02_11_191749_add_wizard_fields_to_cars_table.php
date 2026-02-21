<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('car_type_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('number_of_owners')->nullable();
            $table->json('features')->nullable(); // Store features like ['ABS', 'Airbags']
            $table->longText('description')->nullable();
            $table->boolean('is_published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['car_type_id']);
            $table->dropColumn(['brand_id', 'car_type_id', 'number_of_owners', 'features', 'description', 'is_published']);
        });
    }
};
