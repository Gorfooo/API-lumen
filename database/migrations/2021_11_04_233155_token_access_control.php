<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TokenAccessControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_access_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('url');
            $table->string('token', 400)->nullable();
            $table->timestamp('date_time')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_access_controls');
    }
}
