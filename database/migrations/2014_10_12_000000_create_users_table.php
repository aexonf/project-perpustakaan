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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("id_number")->nullable();
            $table->string("phone_number")->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->enum('role', ["student", "teacher", "librarian"])->nullable();
            $table->enum('status', ['active', 'not_active'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
