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
        Schema::table('resorts', function (Blueprint $table) {
            $table->string('email')->nullable()->after('contact_phone');
        });

        Schema::table('organic_farms', function (Blueprint $table) {
            $table->string('email')->nullable()->after('contact_phone');
        });

        Schema::table('convention_centres', function (Blueprint $table) {
            $table->string('email')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resorts', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('organic_farms', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('convention_centres', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
