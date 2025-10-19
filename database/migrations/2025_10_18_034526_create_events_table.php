<?php

// database/migrations/2025_01_01_000001_create_events_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            
            $table->enum('status', ['upcoming','ongoing','done'])->default('upcoming');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('events');
    }
};
