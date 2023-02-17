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
            $table->id()->default(1);

            $table->string('name')->default('Admin');
            $table->string('email')->unique()->default('admin@gmail.com');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('123');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('role_id')->constrained('roles')->default('1');
            $table->foreignId('department_id')->constrained('departments')->default('1');
            // $table->foreign('role_id')
            //     ->references('id')
            //     ->on('roles')
            //     ->onDelete('cascade');
            // $table->foreign('department_id')
            //     ->references('id')
            //     ->on('departments')
            //     ->onDelete('cascade');
        });
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
