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
        Schema::create('table_vital_signs', function (Blueprint $table) {
            $table->id('sign_id');
            $table->integer('user_id');
            $table->enum('category', ['blood_pressure', 'heart_beat', 'glucose', 'weight']);
            $table->integer('value');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_vital_signs');
    }
};
