<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 150)->unique()->nullable();
            $table->integer('phone')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('company_id');
            $table->string('identy_no');
            $table->string('passport_no')->nullable();
            $table->string('perday_salary')->nullable();
            $table->string('department_id')->nullable();
            $table->string('position')->nullable();
            $table->boolean('status')->default(1);
            $table->date('permit_start')->nullable();
            $table->date('permit_end')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('workers');
    }
}
