<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Avis', function (Blueprint $table) {
            $table->id('idavis');
            $table->unsignedBigInteger('idutilisateur')->nullable();
            $table->integer('idrecette');
            $table->integer('note')->nullable();
            $table->dateTime('dateavis')->nullable();

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
        Schema::dropIfExists('Avis');
    }
};