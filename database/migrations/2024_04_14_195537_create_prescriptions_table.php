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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->integer('prescription_id', true);
            $table->integer('provider_id')->nullable()->index('provider_id');
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('medication_name', 100)->nullable();
            $table->string('dosage', 50)->nullable();
            $table->string('frequency', 50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('summary');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->longText('medicines')->nullable();
            $table->integer('appointment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
};
