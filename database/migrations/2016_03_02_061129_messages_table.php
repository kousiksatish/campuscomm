<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Message', 3000);
            $table->string('Sender');
            $table->string('tags');
            $table->integer('spam')->default(0);
            $table->integer('view_count');
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
        //
        Schema::drop('Messages');
    }
}
