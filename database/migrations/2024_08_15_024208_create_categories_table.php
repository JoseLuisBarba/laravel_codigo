<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->unique();
            $table->timestamps();
        });

        Schema::table('servicios', function(Blueprint $table){
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //definimos relación
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicios', function(Blueprint $table){
            //Borramos la restricción
            $table->dropForeign('servicios_category_id_foreign');
            //borramos el campo
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('categories');
    }
};
