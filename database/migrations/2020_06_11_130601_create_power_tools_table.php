<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('brand');
            $table->integer('price');
            $table->integer('qty');
            $table->string('image')->nullable();
            $table->integer('department_id');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->boolean('condition')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('remark')->nullable();
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
        Schema::dropIfExists('power_tools');
    }
}
