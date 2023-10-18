<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsMadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_made', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained('agreements');
            $table->foreignId('headquarter_id')->constrained('headquarters');
            $table->foreignId('user_id')->constrained('users');
            $table->double('value');
            $table->string('type_payment');
            $table->string('receipt_number', 20)->unique();
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('payments_made');
    }
}
