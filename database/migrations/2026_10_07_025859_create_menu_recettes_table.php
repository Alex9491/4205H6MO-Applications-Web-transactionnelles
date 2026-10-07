<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menu_Recettes', function (Blueprint $table) {
            $table->integer('idmenu');
            $table->integer('idrecette');

            $table->primary(['idmenu', 'idrecette']);

            $table->foreign('idmenu')
                ->references('idmenu')
                ->on('Menus')
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
        Schema::dropIfExists('Menu_Recettes');
    }
};