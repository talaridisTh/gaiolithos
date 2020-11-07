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
            $table->string("title",50)->nullable();
            $table->string("slug",50)->nullable();
            $table->text("description");
            $table->text("summary");
            $table->text("cover");
            $table->string("small_description");
            $table->string("sku");
            $table->float("price");
            $table->float("discount")->nullable();
            $table->integer("quantity");
            $table->boolean("status")->default(0);
            $table->timestamp('publish_at')->nullable();
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
