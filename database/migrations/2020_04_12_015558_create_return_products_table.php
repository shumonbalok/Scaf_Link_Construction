<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('return_order_id')->unsigned()->index('return_orders');
            $table->integer('department_id');
            $table->integer('project_id');
            $table->integer('product_id')->nullable();
            $table->integer('numbers')->nullable();

            $table->foreign('return_order_id')->references('id')->on('return_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_products');
    }
}
