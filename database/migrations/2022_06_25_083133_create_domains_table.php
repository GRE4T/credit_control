<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('provider_id');
            $table->enum('operating_system', ['LINUX','WINDOWS']);
            $table->foreignId('client_id');
            $table->foreignId('server_id');
            $table->string('domain');
            $table->string('website');
            $table->string('authorization_code')->nullable();
            $table->float('annual_price');
            $table->date('expiration_date');
            $table->string('host_FTP');
            $table->string('user_FTP');
            $table->string('password_FTP');
            $table->string('port_FTP');
            $table->string('client_FTP');
            $table->text('observations')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');

            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->foreign('server_id')
                ->references('id')
                ->on('servers');

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
        Schema::dropIfExists('domains');
    }
}
