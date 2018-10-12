<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorAccountRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_account_requests', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_applicant_id'); // FK for 'applicants'
            $table->string('str_first_name');
            $table->string('str_middle_name')
                ->nullable();
            $table->string('str_last_name');
            $table->string('str_email')
                ->unique();
            $table->char('char_request_status', 12)
                ->default('pending');
            $table->string('str_account_request_token');
            $table->timestamps();

            if (Schema::hasTable('applicants')) {
                $table->foreign('int_applicant_id')
                    ->references('int_id')
                    ->on('applicants')
                    ->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_account_requests');
    }
}
