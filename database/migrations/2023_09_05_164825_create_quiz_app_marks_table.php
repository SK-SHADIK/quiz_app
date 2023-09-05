<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAppMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_app.quiz_app_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_app_user_id');
            $table->integer('total_marks');
            $table->string('created_by', 255)->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('updated_by', 255)->nullable();
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('quiz_app_user_id')->references('id')->on('quiz_app.quiz_app_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_app.quiz_app_marks');
    }
}
