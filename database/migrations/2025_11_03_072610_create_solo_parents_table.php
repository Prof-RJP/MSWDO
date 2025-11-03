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
        Schema::create('solo_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('brgy_id')->constrained('barangays')->onDelete('cascade');
            $table->date('applied_date');
            $table->string('id_no');
            $table->string('case_no');
            $table->string('category');
            $table->string('benefits');
            $table->date('exp_date');
            $table->enum('solo_status',['new','renew','expired']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solo_parents');
    }
};
