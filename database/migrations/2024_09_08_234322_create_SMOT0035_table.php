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
        Schema::create('SMOT0035', function (Blueprint $table) {
            $table->id();
            $table->float('port1', 8, 2);
            $table->float('port2', 8, 2);
            $table->float('port3', 8, 2);
            $table->float('port4', 8, 2);
            $table->float('port5', 8, 2);
            $table->float('port6', 8, 2);
            $table->float('port7', 8, 2);
            $table->float('port8', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SMOT0035');
    }
};
