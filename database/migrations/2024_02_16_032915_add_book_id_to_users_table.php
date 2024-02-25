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
        Schema::table('log_book_loan', function (Blueprint $table) {
             // relasi ke book
             $table->unsignedBigInteger('book_id');

             $table->foreign('book_id')
                 ->references('id')
                 ->on('books')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_book_loan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('book_id');
        });
    }
};
