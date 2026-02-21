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
            // Drop existing foreign keys
            $table->dropForeign(['car_make_id']);
            $table->dropForeign(['car_model_id']);

            // Make columns nullable
            $table->unsignedBigInteger('car_make_id')->nullable()->change();
            $table->unsignedBigInteger('car_model_id')->nullable()->change();

            // Re-add foreign keys (optional, if we want to keep them)
            $table->foreign('car_make_id')->references('id')->on('car_makes')->nullOnDelete();
            $table->foreign('car_model_id')->references('id')->on('car_models')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // This down migration might be tricky if data exists with nulls.
            // For now, we just reverse the nullable change if possible, but it might fail.
            // We can just leave it or try to revert.
            $table->dropForeign(['car_make_id']);
            $table->dropForeign(['car_model_id']);

            $table->unsignedBigInteger('car_make_id')->nullable(false)->change();
            $table->unsignedBigInteger('car_model_id')->nullable(false)->change();

            $table->foreign('car_make_id')->references('id')->on('car_makes')->onDelete('restrict');
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('restrict');
        });
    }
};
