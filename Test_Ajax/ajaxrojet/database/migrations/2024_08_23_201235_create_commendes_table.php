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
        Schema::create('commendes', function (Blueprint $table) {

            $table->id();
            $table->string('nom_receveur');
            $table->date('date');
            $table->string('status');
            $table->text('produits');
            $table->date('date_renvoi')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commendes');
    }
};
