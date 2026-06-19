<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyFieldToEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->integer('currency_id')->nullable()->after('viewed');
            $table->string('main_file_type')->nullable()->after('file_type');
            $table->text('main_file_url')->nullable()->after('file_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn('currency_id');
            $table->dropColumn('main_file_type');
            $table->dropColumn('main_file_url');
        });
    }
}
