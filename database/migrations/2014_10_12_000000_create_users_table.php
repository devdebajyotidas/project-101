<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->integer('account_id');
            $table->string('account_type');
            $table->text('fcm_token')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('verification_token', 60)->nullable();
            $table->tinyInteger('mobile_verified')->default('0');
            $table->tinyInteger('email_verified')->default('0');
            $table->tinyInteger('is_employee')->default('0');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
}
