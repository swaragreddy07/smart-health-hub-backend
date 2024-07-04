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
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreign(['user_id'], 'prescriptions_ibfk_2')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
            $table->foreign(['provider_id'], 'prescriptions_ibfk_1')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign('prescriptions_ibfk_2');
            $table->dropForeign('prescriptions_ibfk_1');
        });
    }
};
