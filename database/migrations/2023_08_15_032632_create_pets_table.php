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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            //FOREIGN USER
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();//NOMBRE
            $table->string('color'); //COLOR
            $table->foreignId('gender_id')->nullable()->constrained('genders');//GENERO
            $table->foreignId('size_id')->nullable()->constrained('sizes');//GENERO
            $table->string('race')->nullable();//RAZA
            $table->string('birth')->nullable();//NACIMIENTO
            $table->string('plate')->nullable();//PLACA
            $table->string('locker')->nullable();//CASILLERO
            $table->foreignId('stallion_id')->nullable()->constrained('stallions');//PADRILLO
            $table->foreignId('madrilla_id')->nullable()->constrained('madrillas');//MADRILLO
            $table->foreignId('disabilitie_id')->nullable()->constrained('disabilities');//DISCAPACIDAD
            $table->string('Senasa')->nullable();
            $table->string('atachFile')->nullable();
            $table->string('observation')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
