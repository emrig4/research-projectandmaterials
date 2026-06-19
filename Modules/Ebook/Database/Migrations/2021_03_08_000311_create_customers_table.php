<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_type')->nullable(); // user, guest
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('rave_account_id')->nullable(); //customer id as stored in rave
            $table->string('paystack_account_id')->nullable(); //customer id as stored in rave

            $table->string('phone')->nullable(); 
            $table->string('email')->nullable()->unique();
            $table->string('name')->nullable(); 

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
        Schema::dropIfExists('customers');
    }
}
