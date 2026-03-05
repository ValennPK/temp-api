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
        Schema::create('thermometer_latest', function (Blueprint $table) {
            $table->unsignedBigInteger('thermometer_id')->primary();

            $table->decimal('port1_value', 6, 3)->nullable();
            $table->dateTime('port1_read_at')->nullable();
            $table->decimal('port2_value', 6, 3)->nullable();
            $table->dateTime('port2_read_at')->nullable();
            $table->decimal('port3_value', 6, 3)->nullable();
            $table->dateTime('port3_read_at')->nullable();
            $table->decimal('port4_value', 6, 3)->nullable();
            $table->dateTime('port4_read_at')->nullable();
            $table->decimal('port5_value', 6, 3)->nullable();
            $table->dateTime('port5_read_at')->nullable();
            $table->decimal('port6_value', 6, 3)->nullable();
            $table->dateTime('port6_read_at')->nullable();
            $table->decimal('port7_value', 6, 3)->nullable();
            $table->dateTime('port7_read_at')->nullable();
            $table->decimal('port8_value', 6, 3)->nullable();
            $table->dateTime('port8_read_at')->nullable();

            $table->timestamps();

            $table->foreign('thermometer_id')
                ->references('id')
                ->on('thermometers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thermometer_latest');
    }
};
