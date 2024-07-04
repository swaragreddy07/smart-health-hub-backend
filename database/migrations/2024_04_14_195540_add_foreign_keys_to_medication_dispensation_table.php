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
        Schema::table('medication_dispensation', function (Blueprint $table) {
            $table->foreign(['user_id'], 'medication_dispensation_ibfk_2')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
            $table->foreign(['pharmacist_id'], 'medication_dispensation_ibfk_1')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
            $table->foreign(['prescription_id'], 'medication_dispensation_ibfk_3')->references(['prescription_id'])->on('prescriptions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication_dispensation', function (Blueprint $table) {
            $table->dropForeign('medication_dispensation_ibfk_2');
            $table->dropForeign('medication_dispensation_ibfk_1');
            $table->dropForeign('medication_dispensation_ibfk_3');
        });
    }
};
