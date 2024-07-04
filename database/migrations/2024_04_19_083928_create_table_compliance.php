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
        Schema::create('compliance', function (Blueprint $table) {
            $table->id('compliance_id');
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['healthcare regulation', 'standard', 'legal requirement']);
            $table->boolean('status');
            $table->boolean('issue');
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
        Schema::dropIfExists('table_compliance');
    }
};
