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
            $table->string('engine_size')->nullable()->after('year_of_manufacture');
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric'])->nullable()->after('engine_size');
            $table->enum('transmission', ['manual', 'automatic'])->nullable()->after('fuel_type');
            $table->string('body_type')->nullable()->after('transmission');
            $table->decimal('vrt_amount', 10, 2)->nullable()->after('purchasing_price');
            $table->date('date_vrt_paid')->nullable()->after('vrt_amount');
            $table->decimal('customs_amount', 10, 2)->nullable()->after('date_vrt_paid');
            $table->decimal('vat_on_customs_amount', 10, 2)->nullable()->after('customs_amount');
            $table->text('notes')->nullable()->after('service_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'engine_size',
                'fuel_type',
                'transmission',
                'body_type',
                'vrt_amount',
                'date_vrt_paid',
                'customs_amount',
                'vat_on_customs_amount',
                'notes',
            ]);
        });
    }
};
