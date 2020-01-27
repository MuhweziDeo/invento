<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('size')->nullable(false);
            $table->string('code')->nullable(false);
            $table->boolean('saleable')->nullable(false)->default(true);
            $table->integer('quantity')->nullable(false);
            $table->string('brand')->nullable(false);
            $table->string('name')->nullable(false);
            $table->integer('cost')->nullable(false);
            $table->integer('minimum_quantity')->nullable(false);
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
        Schema::dropIfExists('items');
    }
}
