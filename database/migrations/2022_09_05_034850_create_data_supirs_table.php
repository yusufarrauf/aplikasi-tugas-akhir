<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSupirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_supirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 25);
            $table->string('alamat', 100);
            $table->string('handphone', 15);
            $table->date('tanggal_lahir');
            $table->string('nopol_kendaraan', 10);
            $table->timestamps();
        });
        Schema::table('data_supirs', function (Blueprint $table) {
            $table->foreign('nopol_kendaraan')->references('nopol')->on('data_kendaraans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_supirs');
    }
}
