<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stat', function (Blueprint $table) {
            $table->integer("link_id")->nullable(false);
            $table->integer("user_id")->nullable(false);
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("link_id")->references("id")->on("links")->cascadeOnDelete();
            $table->timestamp("redirected")->nullable(false);
            $table->index(["user_id"]);
            $table->index(["link_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stat');
    }
}
