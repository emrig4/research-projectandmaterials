<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');

            $table->string('price')->nullable(); // service fee
            $table->integer('currency_id')->nullable();
            $table->string('features')->nullable(); //comma delimited list of features

            $table->string('icon_class')->nullable();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('services');
    }
}
