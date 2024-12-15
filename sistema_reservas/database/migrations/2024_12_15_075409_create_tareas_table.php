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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidencia_id')->constrained()->onDelete('cascade');
            $table->string('descripcion');
            $table->enum('estado', ['Asignada', 'En Proceso', 'Solucionada', 'No Solucionada'])->default('Asignada');
            $table->enum('quien_asume_costo', ['Cliente', 'Propietario', 'Homeselect'])->nullable();
            $table->foreignId('encargado_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla 'users'
            $table->decimal('costo', 10, 2)->nullable(); 
            $table->text('comentario')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }

};
