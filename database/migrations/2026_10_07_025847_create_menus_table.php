<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menus', function (Blueprint $table) {
            $table->integer('idmenu')->primary();
            $table->unsignedBigInteger('idutilisateur');
            $table->string('nom', 100)->nullable();
            $table->text('description')->nullable();

            $table->foreign('idutilisateur')
                ->references('idUtilisateurs')
                ->on('Utilisateurs')
                ->noActionOnDelete()
                ->noActionOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menus');
    }
};