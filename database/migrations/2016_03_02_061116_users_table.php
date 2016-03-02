<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('RollNo');
            $table->string('GCM_ID', 500);
            $table->string('AD_ID');
            $table->string('Path');
            $table->integer('Active')->default(1);
            $table->integer('DeviceCount')->default(0);
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
        Schema::drop('Users');
    }
}
