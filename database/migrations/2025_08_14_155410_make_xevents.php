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

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->text('description')->nullable();
        });

        Schema::create('xevents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->enum('type', ['online', 'offline']);
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');
            $table->text('description');
            $table->text('about');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('location');
            $table->string('image_link')->nullable();
            $table->foreignId('organizer_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xevents');
        Schema::dropIfExists('categories');
    }
};
