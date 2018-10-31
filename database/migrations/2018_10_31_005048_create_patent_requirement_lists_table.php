<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatentRequirementListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patent_requirement_lists', function (Blueprint $table) {
            $table->increments('int_id'); // Primary Key
            $table->unsignedInteger('int_requirement_id');
            $table->unsignedInteger('int_patent_id');

            // Assign foreign key for 'patents' table
            if (Schema::hasTable('patents')) {
                $table->foreign('int_patent_id')
                    ->references('int_id')
                    ->on('patents')
                    ->onDelete('cascade');
            }

            // Assign foreign key for 'requirements' table
            if (Schema::hasTable('requirements')) {
                $table->foreign('int_requirement_id')
                    ->references('int_id')
                    ->on('requirements')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('patent_requirement_lists');
    }
}
