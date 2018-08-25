<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create 'messages' table
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('sender_id'); // fk for 'users'
            $table->unsignedInteger('receiver_id'); // fk
            $table->string('str_subject');
            $table->mediumText('mdmTxt_message');
            $table->char('char_message_status', 12);
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
        Schema::dropIfExists('messages');
    }
}
