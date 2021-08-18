<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('kd_pengetahuan', 255);
            $table->text('kd_keterampilan', 255);
            $table->text('materi_pokok');
            $table->text('pembelajaran');
            $table->text('penilaian');
            $table->string('alokasi_waktu', 15);
            $table->text('sumber_belajar');
            $table->integer('guru_id');
            $table->integer('mapel_id');
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
        Schema::dropIfExists('kd');
    }
}
