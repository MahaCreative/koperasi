<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman_users', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjaman');
            $table->foreignId('profile_user_id');
            $table->foreignId('detail_data_pinjaman_id');
            $table->foreignId('petugas_id');
            $table->boolean('status_pinjaman')->default(false);
            $table->boolean('status_lunas')->default(false);
            $table->date('tanggal_pengajuan');
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
        Schema::dropIfExists('pinjaman_users');
    }
}