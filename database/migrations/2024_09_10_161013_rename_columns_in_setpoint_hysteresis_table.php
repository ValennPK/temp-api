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
        Schema::table('setpoint_hysteresis', function (Blueprint $table) {
            $table->renameColumn('upper_hyst', 'upper_s1');
            $table->renameColumn('lower_hyst', 'lower_s1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setpoint_hysteresis', function (Blueprint $table) {
            $table->renameColumn('upper_s1', 'upper_hyst');
            $table->renameColumn('lower_s1', 'lower_hyst');
        });
    }
};
