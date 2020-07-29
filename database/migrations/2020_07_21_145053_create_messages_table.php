<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * after reading it
         * 1 hour from now
         * 24 hours from now
         * 7 days from now
         * 30 days from now
         */
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug', 36);
            $table->string('slug_password');
            $table->text('body');
            $table->string('password')->nullable();
            $table->datetime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
