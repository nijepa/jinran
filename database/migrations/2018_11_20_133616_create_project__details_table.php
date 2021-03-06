<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project__details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->index()->unsigned();
            $table->integer('subtype_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->date('date_pd');
            $table->string('title');
            $table->string('description');
            $table->boolean('finished');
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
        Schema::dropIfExists('project__details');
    }
}
