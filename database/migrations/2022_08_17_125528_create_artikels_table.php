<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(1);
            $table->foreignId('kategori_id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('kontent');
            $table->string('thumbnail');
            $table->string('status_preview');
            $table->string('active')->default(false);
            $table->integer('visitor')->default(0);
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
        Schema::dropIfExists('artikels');
    }
}