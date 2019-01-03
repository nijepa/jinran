<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('admin')->default(0);
            $table->integer('role_id')->index()->unsigned();
            $table->integer('is_active')->default(0);
            $table->integer('company_id')->index()->unsigned();
            $table->string('name');
            $table->string('email', 250);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
