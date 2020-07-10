<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('incentive')->nullable();
            $table->integer('deduction')->nullable();
            $table->string('deduction_for')->nullable();
            $table->string('cheque_no')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('view_btn')->nullable();
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
        Schema::dropIfExists('staff_salaries');
    }
}
