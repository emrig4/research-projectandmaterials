<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPcloudFieldToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->bigInteger('pcloud_fileid')->nullable();
            $table->string('pcloud_folderid')->nullable();
            $table->string('pcloud_filelink')->nullable();
            $table->string('pcloud_path')->nullable();
            $table->string('pcloud_contenttype')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('pcloud_fileid');
            $table->dropColumn('pcloud_folderid');
            $table->dropColumn('pcloud_filelink');
            $table->dropColumn('pcloud_path');
            $table->dropColumn('pcloud_contenttype');
        });
    }
}
