<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerTimecardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_timecards', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('worker_id')->unsigned()->index('workers');
            $table->integer('normal_hrs')->nullable()->default(0);
            $table->integer('ot_hrs')->nullable()->default(0);
            $table->integer('project_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->boolean('supervisor_status')->nullable()->default(0);
            $table->boolean('manager_status')->nullable()->default(0);
            $table->text('remark')->nullable();
            $table->boolean('attendance')->nullable()->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('worker_timecards');
    }
}
