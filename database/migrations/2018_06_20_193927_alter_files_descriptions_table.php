<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFilesDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files_descriptions', function (Blueprint $table) {
            $table->string('bucket_name')->nullable()->after('extention');
            $table->string('end_point')->nullable()->after('bucket_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files_descriptions', function (Blueprint $table) {
            //
        });
    }
}
