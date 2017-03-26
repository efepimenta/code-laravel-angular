<?php

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
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('no action')->onUpdate('no action');
            $table->string('name', 255);
            $table->text('description');
            $table->smallInteger('progress');
            $table->smallInteger('status');
            $table->dateTime('due_date');
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
        Schema::drop('projects');
    }
}
