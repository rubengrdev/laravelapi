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
            $table->string('id',5)->primary();
            $table->string('title',90)->unique();
            $table->string('description',255);
            $table->decimal('price');
            $table->foreignId('company_id')->unsigned;
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreignId('category_id')->unsigned;
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
