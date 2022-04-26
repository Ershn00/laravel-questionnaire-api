<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_question_choices', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedInteger('test_question_id');
//            $table->foreignId('test_question_id')
//                ->constrained()
//                ->onDelete('cascade');
            $table->string('choice_title');
            $table->integer('score');
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
        Schema::dropIfExists('test_answers');
    }
};
