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
        Schema::table('secure_messages', function (Blueprint $table) {
            $table->foreign(['receiver_id'], 'secure_messages_ibfk_2')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
            $table->foreign(['sender_id'], 'secure_messages_ibfk_1')->references(['user_id'])->on('dbt_user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secure_messages', function (Blueprint $table) {
            $table->dropForeign('secure_messages_ibfk_2');
            $table->dropForeign('secure_messages_ibfk_1');
        });
    }
};
