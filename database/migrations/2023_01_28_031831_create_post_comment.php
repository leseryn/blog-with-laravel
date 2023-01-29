<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('user_id');
            $table->integer('parent_id')->nullable();
            $table->string('comment')->nullable();
            $table->integer('count_like')->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comment');
    }
};
