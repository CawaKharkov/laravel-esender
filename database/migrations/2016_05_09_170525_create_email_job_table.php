<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_job', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('from');
            $table->string('titleFrom');
            $table->string('emailTitle');

            $table->tinyInteger('progress')->default(0);
            $table->boolean('finish')->default(false);

            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('email_job');
    }
}
