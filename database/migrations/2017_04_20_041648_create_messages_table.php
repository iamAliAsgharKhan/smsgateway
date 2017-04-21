<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('sender', 30);
            $table->string('receipent', 30);
            $table->text('content');
            $table->enum('type', ['inbox', 'outbox'])->default('inbox');
            $table->enum('status', [
                'unread',
                'read',
                'sent',
                'pending',
                'failed'
            ])->defualt('unread');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
