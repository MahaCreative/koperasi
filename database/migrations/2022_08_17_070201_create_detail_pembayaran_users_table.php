<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembayaranUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembayaran_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_user_id');
            $table->foreignId('pembayaran_user_id');
            $table->integer('angsuran_ke');
            $table->integer('total_pinjaman');
            $table->integer('pembayaran');
            $table->integer('sisa_pinjaman');
            $table->string('satus_angsuran_ke');
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
        Schema::dropIfExists('detail_pembayaran_users');
    }
}