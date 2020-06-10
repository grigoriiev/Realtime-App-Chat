<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_user',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_user',function (Blueprint $table){
         $table->dropForeign('room_user_user_id_foreign');
         $table->dropForeign('room_user_room_id_foreign');
        });
        Schema::dropIfExists('room_user');
    }
}
