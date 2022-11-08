<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBongkarMuatDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bongkar_muat_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bongkar_muat')->unsigned();
            $table->bigInteger('id_supir')->unsigned();
            $table->string('nomor_kontainer', 25);
            $table->string('nomor_segel', 25);
            $table->string('form_inspeksi', 25)->nullable();
            $table->string('form_tally', 25)->nullable();
            $table->string('status', 10);
            $table->timestamps();
        });
        Schema::table('bongkar_muat_details', function (Blueprint $table) {
            $table->foreign('id_bongkar_muat')->references('id')->on('bongkar_muats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_supir')->references('id')->on('data_supirs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bongkar_muat_details');
    }
}
