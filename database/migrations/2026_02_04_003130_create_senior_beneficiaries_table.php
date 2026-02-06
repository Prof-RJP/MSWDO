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
        Schema::create('senior_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->constrained('seniors')->onDelete('cascade');
            $table->enum('sr_beneficiaries',['octo','socpen']);
            $table->enum('status',['waiting','approved']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senior_beneficiaries');
    }
};
