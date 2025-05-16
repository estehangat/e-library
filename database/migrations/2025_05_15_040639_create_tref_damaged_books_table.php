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
        Schema::create('tref_damaged_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('tm_books')->onDelete('cascade');
            $table->date('damaged_at');
            $table->smallInteger('quantity');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tref_damaged_books');
    }
};
