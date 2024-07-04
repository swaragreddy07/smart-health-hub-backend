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
        Schema::table('patient_health_records', function (Blueprint $table) {
            $table->foreign(['user_id'], 'patient_health_records_ibfk_1')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_health_records', function (Blueprint $table) {
            $table->dropForeign('patient_health_records_ibfk_1');
        });
    }
};
