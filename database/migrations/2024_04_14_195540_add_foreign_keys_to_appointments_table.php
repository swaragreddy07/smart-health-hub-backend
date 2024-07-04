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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign(['provider_id'], 'appointments_ibfk_2')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'appointments_ibfk_1')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('appointments_ibfk_2');
            $table->dropForeign('appointments_ibfk_1');
        });
    }
};
