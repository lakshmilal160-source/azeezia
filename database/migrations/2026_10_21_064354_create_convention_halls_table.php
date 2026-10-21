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
         Schema::create('convention_halls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('convention_centre_id')
                ->constrained('convention_centres')
                ->cascadeOnDelete();

            $table->string('name');
            $table->unsignedInteger('seating_capacity')->default(0);
            $table->unsignedInteger('floating_capacity')->default(0);
            $table->unsignedInteger('dining_capacity')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('convention_halls');
    }
};
