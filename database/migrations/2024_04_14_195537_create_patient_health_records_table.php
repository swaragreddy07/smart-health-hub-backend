<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_health_records', function (Blueprint $table) {
            $table->integer('record_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->text('medical_history')->nullable();
            $table->text('prescriptions')->nullable();
            $table->text('vital_signs')->nullable();
            $table->text('exercise_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_health_records');
    }
};
