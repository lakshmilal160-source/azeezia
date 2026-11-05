<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds an icon column to what_we_offers.
     * - icon  : used in the Convention Centre section
     * - image : already exists, used in the Home section
     */
    public function up(): void
    {
        Schema::table('what_we_offers', function (Blueprint $table) {
            $table->string('icon', 500)->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('what_we_offers', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
