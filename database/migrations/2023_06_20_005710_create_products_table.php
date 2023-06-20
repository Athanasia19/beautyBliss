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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // foreign key for categories
            $table->foreign('category_id')
            ->on('categories')
            ->onDelete('cascade');

            

            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->longText('description')->nullable();
            $table->integer('original_price');
            $table->integer('selling_price');
            $table->integer('quantity');
            $table->tinyInteger('trending')
            ->default('0')
            ->comment('1=trending,0=not-trending');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
