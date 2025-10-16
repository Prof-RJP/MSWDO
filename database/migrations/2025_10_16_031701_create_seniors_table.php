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
        Schema::create('seniors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brgy_id')->constrained('barangays')->onDelete('cascade');
            $table->string('osca_id')->nullable();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('contact')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('status',['Active','Deceased']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seniors');
    }
};
