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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('slug',100)->nullable();
            $table->string('seo_title',67)->nullable();
            $table->string('seo_description',155)->nullable();
            $table->string('seo_image',100)->nullable();
            $table->string('name',100)->nullable();
            $table->text('description')->nullable();
            $table->string('image',100)->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('precio_anterior',7,2)->default(0.00);
            $table->decimal('precio',7,2)->default(0.00);
            $table->integer('orden')->nullable();
            $table->integer('visitas')->nullable();
            $table->string('codigo')->nullable();
            $table->boolean('publicado')->default(0); 
            $table->foreignId('subcategoria_id')->references('id')->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
