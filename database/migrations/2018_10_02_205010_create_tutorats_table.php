<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutoratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->unsigned()->index();
            $table->unsignedInteger('tutor_id')->unsigned()->index();
            $table->time('hrstart');
            $table->time('hrfinish');
            $table->date('dtexecution');
            $table->foreign('student_id')
                ->references('id')->on('users');
            $table->foreign('tutor_id')
                ->references('id')->on('users');
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
        Schema::dropIfExists('tutorats');
    }
}
