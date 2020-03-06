<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipsTable extends Migration
{

    public function up() {

        Schema::create('friendships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('recipient_id')->index();
            $table->unsignedBigInteger('sender_id')->index();
            $table->enum('status', ['pending', 'confirmed', 'blocked']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('friendships');
    }

}