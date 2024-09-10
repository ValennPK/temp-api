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
            $table->float('upper_s2', 8, 2)->after('lower_s1');
            $table->float('lower_s2', 8, 2)->after('upper_s2');
            $table->float('upper_s3', 8, 2)->after('lower_s2');
            $table->float('lower_s3', 8, 2)->after('upper_s3');
            $table->float('upper_s4', 8, 2)->after('lower_s3');
            $table->float('lower_s4', 8, 2)->after('upper_s4');
            $table->float('upper_s5', 8, 2)->after('lower_s4');
            $table->float('lower_s5', 8, 2)->after('upper_s5');
            $table->float('upper_s6', 8, 2)->after('lower_s5');
            $table->float('lower_s6', 8, 2)->after('upper_s6');
            $table->float('upper_s7', 8, 2)->after('lower_s6');
            $table->float('lower_s7', 8, 2)->after('upper_s7');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setpoint_hysteresis', function (Blueprint $table) {
            $table->dropColumn([
                'upper_s2', 'lower_s2', 
                'upper_s3', 'lower_s3', 
                'upper_s4', 'lower_s4', 
                'upper_s5', 'lower_s5', 
                'upper_s6', 'lower_s6', 
                'upper_s7', 'lower_s7'
            ]);
        });
    }
};
