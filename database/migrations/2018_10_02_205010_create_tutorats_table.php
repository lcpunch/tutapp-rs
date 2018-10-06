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
            $table->unsignedInteger('tutorat_id')->unsigned()->index();
            $table->unsignedInteger('user_id')->unsigned()->index();
            $table->time('hrstart');
            $table->time('hrfinish');
            $table->date('dtexecution');
            $table->primary(['tutorat_id', 'user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('tutorat_id')
                ->references('tutorat_id')->on('tutorat_user');
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
