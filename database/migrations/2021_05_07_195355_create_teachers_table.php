<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Name');
            $table->bigInteger('Specialication_id')->unsigned();
            $table->bigInteger('Gender_id')->unsigned();
            $table->foreign('Gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->date('Joining_Date');
            $table->text('Address');
            $table->timestamps();
            $table->foreign('Specialication_id')->references('id')->on('specialications')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}