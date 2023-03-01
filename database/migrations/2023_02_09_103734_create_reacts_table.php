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

        Schema::create('reacts', function (Blueprint $table) {
            $table->id();
            //$table->integer('react');
            $table->integer('like');
            $table->integer('dis_like');
            // if ('like' == true) {

            //     'like' + 1;
            // };
            // if ('dis_like' == true) {
            //     'dis_like' - 1;
            // }
            //$table->timestamps();
        });
        Schema::table('reacts', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('ideas_id')->constrained('ideas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reacts');
    }
};
