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
            $table->string('user_id', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_user', 255);
            $table->string('updated_user', 255)->nullable();
            $table->string('deleted_user', 255)->nullable();
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
