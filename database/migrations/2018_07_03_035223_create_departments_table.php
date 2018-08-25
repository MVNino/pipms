<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_college_id')
                ->comment('foreign key for colleges');
            $table->char('char_department_code', 9);
            $table->string('str_department_name');
            $table->mediumText('mdmTxt_department_description');
            $table->string('str_department_profile_image')
                ->default('default_department_profile_image.png');
            $table->string('str_department_banner_image')
                ->default('default_department_banner_image.png');
            $table->timestamps();

            // Assign foreign key for 'colleges' table
            if (Schema::hasTable('colleges')) {
                $table->foreign('int_college_id')
                    ->references('int_id')
                    ->on('colleges')
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
        Schema::dropIfExists('departments');
    }
}
