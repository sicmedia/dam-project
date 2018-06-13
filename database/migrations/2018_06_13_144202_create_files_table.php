<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nombre del archivo.');
            $table->text('description')->comment('Breve descripción de que consiste este archivo.')->nullable();
            $table->integer('client_id')->unsigned()->comment('¿A qué cliente pertenece este archivo?.')->nullable();
            $table->SoftDeletes();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
