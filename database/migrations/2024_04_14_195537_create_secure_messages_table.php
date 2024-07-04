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
        Schema::create('secure_messages', function (Blueprint $table) {
            $table->integer('message_id', true);
            $table->integer('sender_id')->nullable()->index('sender_id');
            $table->integer('receiver_id')->nullable()->index('receiver_id');
            $table->text('message_content')->nullable();
            $table->timestamp('send_date_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secure_messages');
    }
};
