<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable()->comment('0 = success, 1 = failed 2 = refunded, 3 = declined');
            $table->string('reference_id')->nullable(); // from aggregator
            $table->string('payment_type')->nullable(); // bank, card etc
            $table->string('payment_aggregator')->nullable(); // rave, paystack, paypal etc

            $table->text('transaction_payload')->nullable();
            $table->text('transaction_meta')->nullable();
            $table->string('amount')->nullable(); // amount paid
            $table->string('customer_id')->nullable(); 
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
