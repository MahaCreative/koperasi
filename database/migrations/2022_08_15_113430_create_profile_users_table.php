<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16)->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('ttl');
            $table->string('no_telp')->nullable();
            $table->text('alamat');
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->foreignId('pekerjaan_id')->nullable();
            $table->foreignId('petugas_id')->nullable();
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
        Schema::dropIfExists('profile_users');
    }
}