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
        Schema::create('carrusels', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('link',100)->nullable();
            $table->integer('order')->nullable();
            $table->string('image',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrusels');
    }
};
