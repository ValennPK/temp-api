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
        schema::table('setpoint_hysteresis', function (Blueprint $table) {
            $table->float('upper_s1', 8, 2)->after('name');
            $table->float('lower_s1', 8, 2)->after('upper_s1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('setpoint_hysteresis', function (Blueprint $table) {
            $table->dropColumn('upper_s1');
            $table->dropColumn('lower_s1');
        });
    }
};
