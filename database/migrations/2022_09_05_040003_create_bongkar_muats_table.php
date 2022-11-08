<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBongkarMuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bongkar_muats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_krani')->unsigned();
            $table->string('tujuan', 50);
            $table->string('kota', 25);
            $table->string('jenis', 10);
            $table->string('status', 10);
            $table->timestamps();
        });
        Schema::table('bongkar_muats', function (Blueprint $table) {
            $table->foreign('id_krani')->references('id')->on('data_kranis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bongkar_muats');
    }
}
