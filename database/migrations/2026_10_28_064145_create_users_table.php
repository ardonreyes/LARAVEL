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
            $table->integer('id', true);
            $table->string('username', 50)->unique('username');
            $table->string('password');
            $table->string('full_name', 100);
            $table->string('role', 25)->default('User');
            $table->dateTime('created_at');
            $table->string('profile')->nullable();
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
