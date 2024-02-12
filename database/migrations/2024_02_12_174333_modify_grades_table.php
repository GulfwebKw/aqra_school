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
        Schema::table('grades', function (Blueprint $table) {
            $table->tinyInteger('from_year')->after('ordering')->nullable()->default(0);
            $table->tinyInteger('from_month')->after('from_year')->nullable()->default(0);
            $table->tinyInteger('until_year')->after('from_month')->nullable()->default(0);
            $table->tinyInteger('until_month')->after('until_year')->nullable()->default(0);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn(['from_year','from_month','until_year','until_month']);
        });
    }
};
