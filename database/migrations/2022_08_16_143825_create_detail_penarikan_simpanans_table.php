<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenarikanSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penarikan_simpanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penarikan_simpanan_id');
            $table->date('tanggal_penarikan');
            $table->integer('jumlah_simpanan');
            $table->integer('jumlah_penarikan');
            $table->integer('sisa_simpanan');
            $table->foreignId('petugas_id');
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
        Schema::dropIfExists('detail_penarikan_simpanans');
    }
}