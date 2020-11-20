<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('mediables', function (Blueprint $table) {
                $table->unsignedBigInteger('media_id');
                $table->string('mediable_type', 50);
                $table->unsignedBigInteger('mediable_id');
                $table->unsignedTinyInteger('tag'); //! 0 Cover, 1 Gallery, 2 Video, 3 File, 4 PDF/Lesson
                $table->unsignedSmallInteger('order');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediables');
    }
}
