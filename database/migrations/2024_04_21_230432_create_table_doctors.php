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
        Schema::table('dbt_user', function (Blueprint $table) {;
            $table->string('qualification')->default(null);
            $table->string('license_number')->default(null);
            $table->string('specialization')->default(null);
            $table->string('city')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_doctors');
    }
};
