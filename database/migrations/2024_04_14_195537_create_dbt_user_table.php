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
        Schema::create('dbt_user', function (Blueprint $table) {
            $table->integer('user_id', true);
            $table->string('password', 100);
            $table->integer('role_id')->nullable()->index('role_id');
            $table->string('email', 100)->unique('email');
            $table->string('full_name', 100);
            $table->string('activated', 225);
            $table->timestamp('registration_date')->useCurrent();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->date('dob')->nullable();
            $table->string('gender', 225);
            $table->integer('phoneNumber')->nullable();
            $table->string('speciality', 225)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbt_user');
    }
};
