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
        Schema::create('medication_dispensation', function (Blueprint $table) {
            $table->integer('dispensation_id', true);
            $table->integer('pharmacist_id')->nullable()->index('pharmacist_id');
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('prescription_id')->nullable()->index('prescription_id');
            $table->timestamp('dispensation_date_time')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medication_dispensation');
    }
};
