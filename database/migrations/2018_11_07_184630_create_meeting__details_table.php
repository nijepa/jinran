<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->index()->unsigned();
            $table->integer('company_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->string('title');
            $table->string('title_e');
            $table->string('description');
            $table->string('description_e');
            $table->date('date_e');
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
        Schema::dropIfExists('meeting__details');
    }
}
