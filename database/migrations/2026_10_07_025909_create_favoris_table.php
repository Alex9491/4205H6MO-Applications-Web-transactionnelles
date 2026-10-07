<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Favoris', function (Blueprint $table) {
            $table->unsignedBigInteger('idutilisateur');
            $table->integer('idrecette');

            $table->primary(['idutilisateur', 'idrecette']);

            $table->foreign('idutilisateur')
                ->references('idUtilisateurs')
                ->on('Utilisateurs')
                ->noActionOnDelete()
                ->noActionOnUpdate();

            $table->foreign('idrecette')
                ->references('idrecette')
                ->on('Recettes')
                ->noActionOnDelete()
                ->noActionOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Favoris');
    }
};