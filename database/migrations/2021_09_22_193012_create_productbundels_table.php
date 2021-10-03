<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductbundelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productbundels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('item_ids');
            $table->float('cost_price')->default(0);
            $table->float('selling_price')->default(0);
            $table->float('percentage_margin')->default(0);
            $table->float('discount_price')->default(0);
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();
            $table->string('short_description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('productbundels');
    }
}
