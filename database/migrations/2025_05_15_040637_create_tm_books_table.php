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
        Schema::create('tm_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('book_cover');   
            $table->text('description');
            $table->date('published_at');
            $table->smallInteger('version');
            $table->string('isbn_issn');
            $table->smallInteger('quantity');
            $table->smallInteger('pages');
            $table->foreignId('language_id')->constrained('tref_languages')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('tref_categories')->onDelete('cascade');
            $table->foreignId('shelf_id')->constrained('tm_book_shelfs')->onDelete('cascade');
            $table->foreignId('publisher_id')->constrained('tm_publishers')->onDelete('cascade');
            $table->foreignId('genre_id')->constrained('tref_genres')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('tref_book_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_books');
    }
};
