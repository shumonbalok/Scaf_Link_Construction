<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('worker_id')->unsigned()->index('workers');
            $table->integer('ratings');
            $table->timestamps();
            
            $table->foreign('worker_id')->references('id')->on('workers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_ratings');
    }
}
