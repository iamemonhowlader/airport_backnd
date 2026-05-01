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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('code', 20)->unique();

            $table->string('full_name');
            $table->string('phone_number', 30);
            $table->string('email')->nullable();

            $table->string('service_type', 30);
            $table->string('flight_code', 20);
            $table->string('route', 40)->nullable();
            $table->date('service_date')->nullable();
            $table->string('guest_count', 20)->nullable();

            $table->string('ticket_image_path')->nullable();
            $table->text('comment')->nullable();

            $table->string('status', 20)->default('pending'); // pending|confirmed|cancelled|completed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
