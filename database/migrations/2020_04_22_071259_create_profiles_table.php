<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name');
            $table->string('image');
            //$table->string('url')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')->unique()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::table('profiles',function (Blueprint $table){
            $table->dropForeign('profiles_user_id_foreign');
        });
        Schema::dropIfExists('profiles');
    }
}
