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
            $table->id();
            $table->string('name');
            $table->float('upper_s2', 8, 2);
            $table->float('lower_s2', 8, 2);
            $table->float('upper_s3', 8, 2);
            $table->float('lower_s3', 8, 2);
            $table->float('upper_s4', 8, 2);
            $table->float('lower_s4', 8, 2);
            $table->float('upper_s5', 8, 2);
            $table->float('lower_s5', 8, 2);
            $table->float('upper_s6', 8, 2);
            $table->float('lower_s6', 8, 2);
            $table->float('upper_s7', 8, 2);
            $table->float('lower_s7', 8, 2);
            $table->timestamps();
            $table->softDeletes();
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
