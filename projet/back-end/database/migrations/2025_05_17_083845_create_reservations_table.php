<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->dateTime('date');
            $table->enum('statut', ['en_attente', 'en_cours', 'terminé', 'annulé'])->default('en_attente');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();

            // Optional indexing
            $table->index(['client_id', 'vehicule_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
