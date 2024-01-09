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
            $table->tinyInteger('Duration')->after('SCurricullum')->nullable();
            $table->string('leaveReason')->after('Duration')->nullable();
            $table->string('Medical')->after('leaveReason')->nullable();
            $table->tinyInteger('Siblings')->after('Medical')->nullable();
            $table->string('SiblingsName')->after('Siblings')->nullable();
            $table->string('WhichGrades')->after('SiblingsName')->nullable();
            $table->string('PCEnglish')->after('WhichGrades')->nullable();
            $table->string('Marital')->after('PCEnglish')->nullable();
            $table->string('Educational')->after('Marital')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->removeColumn([
                'Duration',
                'leaveReason',
                'Medical',
                'Siblings',
                'SiblingsName',
                'WhichGrades',
                'PCEnglish',
                'Marital',
                'Educational',
            ]);
        });
    }
};
