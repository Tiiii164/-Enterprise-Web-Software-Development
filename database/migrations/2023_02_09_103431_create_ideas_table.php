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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('file_path');
            $table->timestamps();
        });
        //foreign keys 
        Schema::table('ideas', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('categories_id')->constrained('categories');
            $table->foreignId('topics_id')->constrained('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
};
