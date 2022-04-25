<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenyucianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penyucian', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('penyucian_id');
            $table->unsignedBigInteger('jenis_cuci_id');
            $table->integer('berat');
            $table->integer('total_harga');
            $table->foreign('penyucian_id')->references('id')->on('penyucian');
            $table->foreign('jenis_cuci_id')->references('id')->on('jenis_cuci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penyucian');
    }
}
