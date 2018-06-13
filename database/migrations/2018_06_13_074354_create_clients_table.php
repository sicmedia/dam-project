<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nombre del cliente.');
            $table->text('description')->comment('e.g -> Razon social del cliente.');
            $table->integer('category_client_id')->unsigned()->comment('¿A qué categoría pertenece este cliente?')->nullable();
            $table->integer('status_client_id')->unsigned()->comment('¿Qué servicios tiene este cliente?')->nullable();
            $table->SoftDeletes();
            $table->timestamps();

            $table->foreign('category_client_id')->references('id')->on('category_clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_client_id')->references('id')->on('status_clients')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
