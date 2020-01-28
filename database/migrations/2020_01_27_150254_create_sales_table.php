<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity')->nullable(false);
            $table->integer('staff_id');
            $table->timestamps();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('staff_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
