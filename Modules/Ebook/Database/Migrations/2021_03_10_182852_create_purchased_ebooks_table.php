<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebook_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->boolean('is_delivered')->default(0);
            $table->integer('download_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('ebook_id')->references('id')->on('ebooks')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_ebooks');
    }
}
