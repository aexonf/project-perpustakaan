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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('series_title')->nullable();
            $table->string('call_no')->nullable();
            $table->string('description')->nullable();
            $table->string('publisher')->nullable();
            $table->string('physical_description')->nullable();
            $table->string('language')->nullable();
            $table->string('isbn_issn')->nullable();
            $table->string('classification')->nullable();
            $table->string('content_type')->nullable();
            $table->string('media_type')->nullable();
            $table->string('carrier_type')->nullable();
            $table->string('stock')->nullable();
            $table->string('edition')->nullable();
            $table->string('subject')->nullable();
            $table->string('loan_count')->nullable()->default(0);
            $table->string('specific_details_info')->nullable();
            $table->string('statement')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'blank'])->nullable(); // Ubah menjadi nullable
            // relasi ke users
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
