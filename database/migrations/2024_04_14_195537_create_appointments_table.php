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
        Schema::create('appointments', function (Blueprint $table) {
            $table->integer('appointment_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('provider_id')->nullable()->index('provider_id');
            $table->dateTime('appointment_date')->nullable();
            $table->enum('status', ['scheduled', 'cancelled', 'completed'])->nullable()->default('scheduled');
            $table->time('appointment_time');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
