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
        Schema::create('SMOT0036', function (Blueprint $table) {
            $table->id(); // ID autoincremental
    
            // Campos de tipo INT
            $table->integer('port1');
            $table->integer('port2');
            $table->integer('port3');
            $table->integer('port4');
            $table->integer('port5');
            $table->integer('port6');
            $table->integer('port7');
            $table->integer('port8');
    
            // Timestamps típicos
            $table->timestamps(); // created_at, updated_at
    
            // Campo para borrado lógico
            $table->softDeletes(); // deleted_at
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperatures');
    }
};
