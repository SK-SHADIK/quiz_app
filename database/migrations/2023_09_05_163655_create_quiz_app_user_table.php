<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAppUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_app.quiz_app_user', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 255);
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->string('address', 255);
            $table->date('dob');
            $table->string('gender', 20);
            $table->string('password', 255);
            $table->string('user_type', 255);
            $table->boolean('is_active');
            $table->string('created_by', 255)->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('updated_by', 255)->nullable();
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_app.quiz_app_user');
    }
}
