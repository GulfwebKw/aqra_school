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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('invoiceReference')->nullable();
            $table->string('invoiceId')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->boolean('paid')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['invoiceReference','invoiceId','paid_at','paid']);
        });
    }
};
