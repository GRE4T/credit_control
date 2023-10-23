<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained('agreements');
            $table->foreignId('headquarter_id')->constrained('headquarters');
            $table->foreignId('user_id')->constrained('users');
            $table->string('invoice_pos_number')->unique();
            $table->string('invoice_agreement')->unique();
            $table->double('value');
            $table->text('detail');
            $table->date('expiration_date');
            $table->foreignId('invoice_state_id')->constrained('invoice_states');
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
        Schema::dropIfExists('invoices');
    }
}
