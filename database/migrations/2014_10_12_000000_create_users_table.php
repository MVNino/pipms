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
            $table->string('str_first_name');
            $table->string('str_middle_name')->nullable();
            $table->string('str_last_name');
            $table->string('str_username')
                ->unique();
            $table->string('email')
                ->unique();
            $table->string('password');
            $table->string('str_user_image_code')
                ->default('default_user_image.png');
            $table->tinyInteger('status')
                ->default(1); // (0) - Inactive || (1) - Active
            $table->tinyInteger('isAdmin')
                ->default(1); // (0) - !admin(author) || (1) - admin
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
