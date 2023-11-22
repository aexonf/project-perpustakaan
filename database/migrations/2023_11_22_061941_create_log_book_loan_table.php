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
        Schema::create('log_book_loan', function (Blueprint $table) {
            $table->id();

            // relasi ke student
            $table->unsignedBigInteger('student_id');

            $table->foreign('student_id')->references('id')->on('students');

            // relasi ke librarian
            $table->unsignedBigInteger('librarian_id');

            $table->foreign('librarian_id')->references('id')->on('librarian');

            // relasi ke books
            $table->unsignedBigInteger('book_id');

            $table->foreign('book_id')->references('id')->on('books');

            $table->string("loan_date");
            $table->string("return_date");
            $table->enum("status", ['pending', 'returned'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_book_loan');
    }
};
