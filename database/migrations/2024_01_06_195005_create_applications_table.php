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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('SFName')->nullable();
            $table->string('SNationlity')->nullable();
            $table->date('dob')->nullable();
            $table->string('Sex')->nullable();
            $table->string('SCivilId')->nullable();
            $table->string('SPreviousSchool')->nullable();
            $table->string('SCurricullum')->nullable();
            $table->unsignedBigInteger('Grade_id')->nullable();
            $table->string('SHAddress')->nullable();
            $table->string('FName')->nullable();
            $table->string('FNationlity')->nullable();
            $table->string('FCivilId')->nullable();
            $table->string('FMobile')->nullable();
            $table->string('FEmail')->nullable();
            $table->string('FOccupation')->nullable();
            $table->string('FBAddress')->nullable();
            $table->string('MName')->nullable();
            $table->string('MNationlity')->nullable();
            $table->string('MCivilId')->nullable();
            $table->string('MMobile')->nullable();
            $table->string('MEmail')->nullable();
            $table->string('MOccupation')->nullable();
            $table->string('MBAddress')->nullable();
            $table->string('HowDidYouKnow')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
