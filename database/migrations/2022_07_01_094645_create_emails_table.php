<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('provider_id');
            $table->string('type');
            $table->string('email');
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('url_access');
            $table->date('expiration_from')->nullable();
            $table->date('expiration_to')->nullable();
            $table->text('security_question')->nullable();
            $table->text('annotations')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');

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
        Schema::dropIfExists('emails');
    }
}
