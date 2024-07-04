<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dbt_user')->insert([
            'full_name' => 'swarag Doe',
            'email' => 'admin@gmail.com',
            'dob' => '1990-01-01',
            'phoneNumber' => '1234567890',
            'gender' => 'male',
            'password' => bcrypt('admin'),
            'role_id' => 3,
            'activated' => true,
            'created_at' => now(),
            'updated_at' => now(),
            // Add other columns and values as needed
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dbt_user', function (Blueprint $table) {
            //
        });
    }
};
