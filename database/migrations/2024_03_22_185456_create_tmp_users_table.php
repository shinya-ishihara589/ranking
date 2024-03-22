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
        Schema::create('tmp_users', function (Blueprint $table) {
            $table->id();
            $table->string('tmp_user_id', 255);
            $table->string('tmp_email', 255);
            $table->string('onetime_password', 255);
            $table->timestamp('datetime');
            $table->string('ip', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_users');
    }
};
