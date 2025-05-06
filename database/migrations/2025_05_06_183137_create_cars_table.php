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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_make_id')->constrained()->onDelete('restrict');
            $table->foreignId('car_model_id')->constrained()->onDelete('restrict');
            $table->string('registration_number')->unique();
            $table->string('chassis_number')->unique();
            $table->string('color');
            $table->year('year_of_manufacture');
            $table->decimal('purchasing_price', 10, 2);
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('sold_price', 10, 2)->nullable();
            $table->integer('mileage');
            $table->enum('nct_status', ['valid', 'expired', 'due_soon']);
            $table->date('nct_expiry_date')->nullable();
            $table->enum('status', ['available', 'sold', 'in_service']);
            $table->date('collection_date')->nullable();
            $table->text('service_notes')->nullable();
            $table->enum('radio_status', ['working', 'not_working', 'needs_repair']);
            $table->enum('paint_condition', ['excellent', 'good', 'fair', 'poor']);
            $table->enum('valet_status', ['completed', 'pending', 'not_required']);
            $table->enum('tyre_condition', ['excellent', 'good', 'fair', 'poor']);
            $table->enum('back_camera_status', ['working', 'not_working', 'not_available']);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
