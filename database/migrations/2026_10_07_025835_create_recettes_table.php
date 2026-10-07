<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Recettes', function (Blueprint $table) {
            $table->integer('idrecette')->primary();
            $table->unsignedBigInteger('idutilisateur');
            $table->integer('idcategorie');
            $table->string('nom', 150)->nullable();
            $table->text('description')->nullable();

            $table->foreign('idutilisateur')
                ->references('idUtilisateurs')
                ->on('Utilisateurs')
                ->noActionOnDelete()
                ->noActionOnUpdate();

            $table->foreign('idcategorie')
                ->references('idcategorie')
                ->on('Categories')
                ->noActionOnDelete()
                ->noActionOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Recettes');
    }
};