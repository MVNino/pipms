<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_user_id')
                ->comment('foreign key for users')
                ->nullable();
            $table->unsignedInteger('int_department_id')
                ->comment('foreign key for departments');
            $table->string('str_first_name');
            $table->string('str_middle_name')
                ->nullable();
            $table->string('str_last_name');
            $table->string('str_email_address')
                ->unique();

            // Assign foreign key for 'users' table
            if (Schema::hasTable('users')) {
                $table->foreign('int_user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            }

            // Assign foreign key for 'departments' table
            if (Schema::hasTable('departments')) {
                $table->foreign('int_department_id')
                    ->references('int_id')
                    ->on('departments')
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
        Schema::dropIfExists('faculties');
    }
}
