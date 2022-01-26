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
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->bigInteger("price");
            $table->bigInteger("stock")->default(0);
            $table->longText("description");
            $table->text("excerpt");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("brand_id");
            $table->enum("gender",[0,1,2]);
            $table->string("feature_image");
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
