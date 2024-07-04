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
        Schema::create('table_configuration', function (Blueprint $table) {
            $table->id('config_id');
            $table->string('description')->default('null');
            $table->string('type')->default('null');
            $table->string('value')->default('null');
            $table->string('config')->default('null');
            $table->string('affected_data')->default('null');
            $table->timestamp('time')->nullable();
            $table->string('severity')->default('null');
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
        Schema::dropIfExists('table_configuration');
    }
};
