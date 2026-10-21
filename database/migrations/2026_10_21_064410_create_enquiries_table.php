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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 30);
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('enquiry_type', 50)->nullable();

            $table->foreignId('convention_centre_id')
                ->nullable()
                ->constrained('convention_centres')
                ->nullOnDelete();

            $table->foreignId('resort_id')
                ->nullable()
                ->constrained('resorts')
                ->nullOnDelete();

            $table->foreignId('organic_farm_id')
                ->nullable()
                ->constrained('organic_farms')
                ->nullOnDelete();

            $table->string('status', 30)->default('new');
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
