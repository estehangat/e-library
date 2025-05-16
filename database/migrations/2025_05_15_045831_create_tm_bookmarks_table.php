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
        Schema::create('tm_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('login_user')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('tm_books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_bookmarks');
    }
};
