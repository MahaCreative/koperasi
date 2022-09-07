<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileKoperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_koperasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_koperasi');
            $table->string('nama_perusahaan')->nullable();
            $table->string('badan_hukum')->nullable();
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('no_telp');
            $table->string('fax')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('nama_bendahara')->nullable();
            $table->string('nama_sekretaris')->nullable();
            $table->string('logo');
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
        Schema::dropIfExists('profile_koperasis');
    }
}