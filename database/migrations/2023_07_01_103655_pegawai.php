<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function(Blueprint $bp){
            $bp->id();
            $bp->string('nip', 16)->nullable(false);
            $bp->string('nama_lengkap', 80)->nullable(false);
            $bp->enum('jenis_kelamin', ['L', 'P'])->nullable(true);
            $bp->string('jabatan', 80)->nullable(true);
            $bp->string('alamat', 500)->nullable(true);
            $bp->string('no_hp', 20)->nullable(true);
            $bp->text('lokasi')->nullable(false);
            $bp->unsignedBigInteger('pengguna_id');
            $bp->dateTime('dt_created');
            $bp->dateTime('dt_updated');
            $bp->foreign('pengguna_id', 'fk_tb_pegawai_tb_pengguna_id')
                ->on('tb_pengguna')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawai');
    }
}
