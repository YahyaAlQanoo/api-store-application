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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
             $table->foreignId('product_id')
            ->nullable()
            ->constrained('products')
            ->nullOnDelete();
            $table->text('Description');
            $table->decimal('price');
            $table->text('image')->nullable();
            $table->string('color')->nullable();
            $table->text('size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
