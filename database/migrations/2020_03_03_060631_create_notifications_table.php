<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); //notifiction id
            $table->string('type'); // recode all notification App/Notifiction/name
            $table->morphs('notifiable'); //mode notifiy
            $table->text('data'); //data notification such as message notifiction
            $table->timestamp('read_at')->nullable(); //time user notifiy read 
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
        Schema::dropIfExists('notifications');
    }
}
