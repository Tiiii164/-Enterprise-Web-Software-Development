<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Db;

class LaratrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('day_time');
        });

        // Create table for storing topics        
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('closure_date');
            $table->date('final_closure_date');
        });

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create table for storing departments
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        // DB::table('departments')->insert([
        //     'name' => 'IT',
        // ]);
        
        // Create table for storing user
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //$table->foreignId('departments_id')->constrained('departments');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create table for storing ideas
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('file_path');
            $table->timestamps();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('dislikes_count')->default(0);
            $table->foreignId('user_id')->constrained('user');
            $table->foreignId('topics_id')->constrained('topics');
            $table->foreignId('departments_id')->constrained('departments');
            $table->foreignId('categories_id')->constrained('categories');
        });

        // Create table for storing comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignId('user_id')->constrained('user');
            $table->foreignId('ideas_id')->constrained('ideas');
            $table->timestamps();
        });

        // Create table for storing reacts
        Schema::create('reacts', function (Blueprint $table) {
            $table->id();
            $table->boolean('like')->nullable();
            $table->boolean('dislike')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ideas_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('ideas_id')->references('id')->on('ideas')->onDelete('cascade');
            $table->unique(['user_id', 'ideas_id']);
        });

        // Create table for storing views
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->boolean('isView')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('user');
            $table->foreignId('ideas_id')->constrained('ideas');
        });
        
        Schema::create('departments_user', function (Blueprint $table) {
            $table->unsignedBigInteger('departments_id');
            $table->unsignedBigInteger('user_id');

            $table->primary(['user_id', 'departments_id']);
        });

        // Create table for associating roles to user and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for associating permissions to user (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['user_id', 'permission_id']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->primary(['permission_id', 'role_id']);
        });

        // Create table for storing pass_tokens
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create table for storing failed_job
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');

        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permissions');

        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');

        Schema::dropIfExists('permission_role');
    }
}
