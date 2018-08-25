<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_authors', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_applicant_id')
                ->comment('foreign key for applicants');
            $table->string('str_first_name');
            $table->string('str_middle_name')
                ->nullable();
            $table->string('str_last_name');

            if (Schema::hasTable('applicants')) {
                $table->foreign('int_applicant_id')
                    ->references('int_id')
                    ->on('applicants')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
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
        Schema::dropIfExists('co_authors');
    }
}
