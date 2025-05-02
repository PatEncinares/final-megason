<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('item_name');
            $table->string('item_description');
            $table->integer('item_price');
            $table->integer('quantity');
            $table->string('arrival_date');
            $table->string('expiration_date');
            $table->integer('add_stock');
            $table->integer('pull_out_stock');
            $table->integer('updated_by');
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
        Schema::dropIfExists('inventories');
    }
}
