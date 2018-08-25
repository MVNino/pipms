<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('int_id');
            $table->unsignedInteger('int_department_id')
                ->comment('foreign key for departments'); // FK for 'departments'
            $table->unsignedInteger('int_project_type_id')
                ->comment('foreign key for project_types'); // FK for 'project_types'
            $table->string('str_project_name');
            $table->char('int_year_level', 3);
            $table->char('char_semester', 3);
            $table->mediumText('mdmTxt_project_description');
            $table->timestamps();

            // Assign foreign key for 'departments' table
            if (Schema::hasTable('departments')) {
                $table->foreign('int_department_id')
                    ->references('int_id')
                    ->on('departments')
                    ->onUpdate('cascade');
            }

            // Assign foreign key for 'project_types' table
            if (Schema::hasTable('project_types')) {
                $table->foreign('int_project_type_id')
                    ->references('int_id')
                    ->on('project_types')
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
        Schema::dropIfExists('projects');
    }
}
