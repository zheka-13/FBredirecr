<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->integer("id")->autoIncrement();
            $table->integer("user_id")->nullable(false);
            $table->string("name")->nullable();
            $table->string("link")->nullable(false);
            $table->string("hash")->nullable();
            $table->string("image_file")->nullable(false);
            $table->string("header")->nullable();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->index("hash");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
