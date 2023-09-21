<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('provider_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->enum('operating_system', ['LINUX','WINDOWS']);
            $table->text('server');
            $table->string('username');
            $table->text('password');
            $table->text('url')->nullable();
            $table->double('annual_cost')->nullable();
            $table->text('annotations')->nullable();
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
        Schema::dropIfExists('servers');
    }
}
