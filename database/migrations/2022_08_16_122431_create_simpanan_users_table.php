<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpananUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_simpanan_id')->nullable();
            $table->foreignId('pinjaman_user_id')->nullable();
            $table->foreignId('profile_user_id');
            $table->foreignId('petugas_id');
            $table->string('kode_simpanan');
            $table->integer('jumlah_simpanan')->nullable();
            $table->boolean('status_simpanan')->default(false);
            $table->string('keterangan')->default('belum ditarik');
            $table->date('tanggal_simpanan');
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
        Schema::dropIfExists('simpanan_users');
    }
}