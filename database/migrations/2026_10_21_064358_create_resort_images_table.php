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
        Schema::create('resort_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resort_id')
                ->constrained('resorts')
                ->cascadeOnDelete();

            $table->foreignId('resort_room_type_id')
                ->nullable()
                ->constrained('resort_room_types')
                ->nullOnDelete();

            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resort_images');
    }
};
