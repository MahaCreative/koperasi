<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDataPinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pinjaman_id')->constrained()->references('id')->on('data_pinjamen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('data_angsuran_id')->constrained()->references('id')->on('data_angsurans')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('angsuran');
            $table->integer('simpanan');
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
        Schema::dropIfExists('detail_data_pinjamen');
    }
}