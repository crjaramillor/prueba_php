<?php

// Migración para reservas
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin'); 
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('reservas');
    }

    
}
