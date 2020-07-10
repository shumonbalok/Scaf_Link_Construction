<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pdt_code');
            $table->string('wight');
            $table->string('barcode');
            $table->integer('category_id')->unsigned()->nullable()->default(0)->index('categories');
            $table->integer('department_id')->unsigned()->nullable()->default(0)->index('departments');
            $table->integer('total');
            $table->integer('alertQty');
            $table->string('image')->nullable();
            $table->string('size')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->text('descp', 1000);
            $table->softDeletes();

            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
