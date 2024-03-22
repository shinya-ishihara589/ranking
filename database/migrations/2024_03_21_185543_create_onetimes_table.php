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
        Schema::create('onetimes', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->nullable();
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
        Schema::dropIfExists('onetimes');
    }
};
