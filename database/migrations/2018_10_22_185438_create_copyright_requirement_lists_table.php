<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopyrightRequirementListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copyright_requirement_lists', function (Blueprint $table) {
            $table->increments('int_id'); // Primary Key
            $table->unsignedInteger('int_requirement_id');
            $table->unsignedInteger('int_copyright_id');

            // Assign foreign key for 'copyrights' table
            if (Schema::hasTable('copyrights')) {
                $table->foreign('int_copyright_id')
                    ->references('int_id')
                    ->on('copyrights')
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
        Schema::dropIfExists('copyright_requirement_lists');
    }
}
