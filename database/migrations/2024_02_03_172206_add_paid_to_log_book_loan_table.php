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
            $table->string("loan_end_date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_book_loan', function (Blueprint $table) {
            $table->dropColumn('loan_end_date');
        });
    }
};
