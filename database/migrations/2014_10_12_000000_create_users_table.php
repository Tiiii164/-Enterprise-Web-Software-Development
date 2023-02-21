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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        // Schema::table('users', function (Blueprint $table) {

        //     $table->foreignId('role_id')->constrained('roles');
        //     $table->foreignId('department_id')->constrained('departments');
        //     // $table->foreign('role_id')
        //     //     ->references('id')
        //     //     ->on('roles')
        //     //     ->onDelete('cascade');
        //     // $table->foreign('department_id')
        //     //     ->references('id')
        //     //     ->on('departments')
        //     //     ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
