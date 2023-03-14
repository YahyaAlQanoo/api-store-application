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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['pending','on_way','complete']);
             $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

           $table->dateTime('datetime');
           $table->string('lat_and_long')->nullable();
           $table->string('location')->nullable();
           $table->text('total-price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
