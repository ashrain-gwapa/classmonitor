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
    Schema::create('laboratories', function (Blueprint $table) {
        $table->id();
        $table->string('lab_name'); // e.g., "Lab 1", "IT Lab"
        $table->string('section_name')->nullable(); // e.g., "BSIT 3-C"
        $table->enum('status', ['Available', 'Occupied'])->default('Available');
        // This tracks which Faculty member last updated the status
        $table->foreignId('updated_by_faculty_id')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
