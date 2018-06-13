<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nombre directamente del arhivo.');
            $table->string("path")->nullable();
            $table->integer('size')->comment('Peso del archivo.');
            $table->string('extention')->comment('Tipo de archivo.');
            $table->integer('file_id')->unsigned()->comment('¿A que archivo pertenece esta descripción?.');
            $table->SoftDeletes();
            $table->timestamps();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_descriptions');
    }
}
