<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->date('date_c');
            $table->string('comment');
            $table->integer('votes')->default(0);
            $table->integer('spam')->default(0);
            $table->integer('reply_id')->default(0);
            $table->string('page_id')->default(0);
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
        Schema::dropIfExists('comments');
    }
}
