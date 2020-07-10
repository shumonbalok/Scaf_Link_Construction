<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTestomonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_testomonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profasion_companey');
            $table->text('quote');
            $table->string('image');
            $table->tinyInteger('status')->nullable(0);
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
        Schema::dropIfExists('client_testomonials');
    }
}
