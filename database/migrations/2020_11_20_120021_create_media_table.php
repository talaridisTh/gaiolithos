<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('path')->nullable(); // depends if we want to keep emporium data structuring
            $table->string('filename', 255)->nullable()->index();
            $table->string('slug_name')->nullable()->index(); // slug clean name, with possible increments if duplicate exists

            $table->string('ext', 10)->nullable(); // the extensions of the media
            $table->string('type'); // image, file, video etc, 9 => ad
            $table->string('mime_type')->nullable(); // the mime / file info, think about cases of videos


            $table->unsignedMediumInteger('size')->nullable();


            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
