<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Utilisateurs', function (Blueprint $table) {
            $table->id('idUtilisateurs');
            $table->string('nom', 100);
            $table->string('courriel', 255)->unique();
            $table->string('motdepasse', 255);
            $table->string('role', 20)->default('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Utilisateurs');
    }
};