<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id');
            $table->foreignId('provider_id');
            $table->foreignId('client_id');
            $table->foreignId('user_id');
            $table->string('type');
            $table->text('certificate');
            $table->date('expiration_from')->nullable();
            $table->date('expiration_to')->nullable();
            $table->string('IP_address')->nullable();
            $table->text('private_key')->nullable();
            $table->text('CA_bundle')->nullable();
            $table->text('annotations')->nullable();

            $table->foreign('domain_id')
                ->references('id')
                ->on('domains');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');

            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('certificates');
    }
}
