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
         Schema::create('resort_room_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resort_id')
                ->constrained('resorts')
                ->cascadeOnDelete();

            $table->string('name'); // 2BHK, 4BHK
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('bedrooms');
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedInteger('max_guests')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('price_unit', 30)->default('per night');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resort_room_types');
    }
};
