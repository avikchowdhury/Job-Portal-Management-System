<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('company_id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->text('roles');
            $table->integer('category_id');
            $table->integer('number_of_vacancy');
            $table->integer('experience');
            $table->string('gender');
            $table->string('salary');
            $table->string('position');
            $table->string('address');
            $table->string('type');
            $table->integer('status');
            $table->date('last_date');
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
        Schema::dropIfExists('jobs');
    }
}
