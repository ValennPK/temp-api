<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('setpoint_hysteresis', function (Blueprint $table) {
            $table->id(); // Crea el campo id autoincremental
            $table->string('name'); // Crea el campo name de tipo string
            $table->integer('upper_hyst'); // Crea el campo upper_hyst
            $table->integer('lower_hyst'); // Crea el campo lower_hyst
            $table->timestamps(); // Crea los campos created_at y updated_at
            $table->softDeletes(); // Crea el campo deleted_at para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setpoint_hysteresis');
    }
};
