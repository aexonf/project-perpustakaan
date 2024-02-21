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

            $table->string('series_title');
            $table->string('call_no');
            $table->string('description');
            $table->string('publisher');
            $table->string('physical_description');
            $table->string('language');
            $table->string('isbn/issn');
            $table->string('classification');
            $table->string('contetn_type');
            $table->string('media_type');
            $table->string('carrier_type');
            $table->string('edition');
            $table->string('subject');
            $table->string('specific_details_info');
            $table->string('statement');
            $table->string('responsibility');
            $table->string('image')->nullable(true);
            $table->enum('status', ['available', 'blank']);
            // relasi ke users
            $table->unsignedBigInteger('user_id');

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
