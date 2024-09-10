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
            $table->float('upper_hyst', 8, 2)->change();
            $table->float('lower_hyst', 8, 2)->change();
        });
        Schema::table('smot0035', function (Blueprint $table) {
            $table->float('port1', 8, 2)->change();
            $table->float('port2', 8, 2)->change();
            $table->float('port3', 8, 2)->change();
            $table->float('port4', 8, 2)->change();
            $table->float('port5', 8, 2)->change();
            $table->float('port6', 8, 2)->change();
            $table->float('port7', 8, 2)->change();
            $table->float('port8', 8, 2)->change();
        });
        Schema::table('smot0036', function (Blueprint $table) {
            $table->float('port1', 8, 2)->change();
            $table->float('port2', 8, 2)->change();
            $table->float('port3', 8, 2)->change();
            $table->float('port4', 8, 2)->change();
            $table->float('port5', 8, 2)->change();
            $table->float('port6', 8, 2)->change();
            $table->float('port7', 8, 2)->change();
            $table->float('port8', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setpoints', function (Blueprint $table) {
            $table->integer('upper_hyst')->change();
            $table->integer('lower_hyst')->change();
        });
        Schema::table('smot0035', function (Blueprint $table) {
            $table->integer('port1')->change();
            $table->integer('port2')->change();
            $table->integer('port3')->change();
            $table->integer('port4')->change();
            $table->integer('port5')->change();
            $table->integer('port6')->change();
            $table->integer('port7')->change();
            $table->integer('port8')->change();
        });
        Schema::table('smot0036', function (Blueprint $table) {
            $table->integer('port1')->change();
            $table->integer('port2')->change();
            $table->integer('port3')->change();
            $table->integer('port4')->change();
            $table->integer('port5')->change();
            $table->integer('port6')->change();
            $table->integer('port7')->change();
            $table->integer('port8')->change();
        });
    }
};
