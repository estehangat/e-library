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
        Schema::create('tm_borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('login_user')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('tm_books')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('tref_borrow_status')->onDelete('cascade');
            $table->date('borrow_date');
            $table->date('borrow_due');
            $table->date('return_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_borrows');
    }
};
