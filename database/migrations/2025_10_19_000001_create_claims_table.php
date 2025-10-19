<?php

// database/migrations/2025_01_01_000002_create_claims_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('senior_id')->constrained()->cascadeOnDelete();
            $table->string('remark')->nullable();
            $table->enum('status', ['claimed','unclaimed'])->default('unclaimed');
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();

            $table->unique(['event_id','senior_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('claims');
    }
};
