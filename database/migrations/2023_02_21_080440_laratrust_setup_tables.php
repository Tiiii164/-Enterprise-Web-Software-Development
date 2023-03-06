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

        // Seed for departments
        DB::table('departments')->insert([
            'name' => 'All',
        ]);

        // Create table for storing users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('department_id')->constrained('departments');
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
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('categories_id')->constrained('categories');
            $table->foreignId('topics_id')->constrained('topics');
        });

        // Create table for storing comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->timestamps();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('ideas_id')->constrained('ideas');
        });

        // Create table for storing reacts
        Schema::create('reacts', function (Blueprint $table) {
            $table->id();
            $table->boolean('like')->nullable();
            $table->boolean('dislike')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ideas_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ideas_id')->references('id')->on('ideas')->onDelete('cascade');
            $table->unique(['user_id', 'ideas_id']);
        });

        // Create table for storing views
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->boolean('isView')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('ideas_id')->constrained('ideas');
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'permission_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('users');
        Schema::dropIfExists('departments');

        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permissions');

        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');

        Schema::dropIfExists('permission_role');
    }
}
