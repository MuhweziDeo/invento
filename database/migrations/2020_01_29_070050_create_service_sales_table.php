<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id');
            $table->integer('item_id');
            $table->boolean('optional')->default(false);
            $table->integer('customer_id');
            $table->timestamps();
        });

        Schema::table('service_sales', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services')
                ->onDelete('cascade');

            $table->foreign('customer_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
        });

    //TODO add Schema relationships
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_sales');
    }
}
