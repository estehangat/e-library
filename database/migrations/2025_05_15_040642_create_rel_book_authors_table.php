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
        Schema::create('rel_book_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('tm_books')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('tm_authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rel_book_authors');
    }
};
