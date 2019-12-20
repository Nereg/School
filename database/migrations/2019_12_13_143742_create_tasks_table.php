<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start')->comment('When you need to start to work');
            $table->char('name', 255)->comment('Name of task');
            $table->char('description')->comment('Description of task')->nullable();
            $table->integer('userId')->comment('Id of user that created that task');
            $table->integer('priority')->comment('Priority of that task (not used in current version)')->nullable();
            $table->json('data')->comment('Additional data (not used in current version)')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
