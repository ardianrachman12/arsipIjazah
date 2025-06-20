<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijazahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('nomor_ijazah')->unique();
            $table->string('nomor_seri')->nullable();
            $table->year('tahun_lulus');
            $table->string('nilai_rata_rata');
            $table->string('file_ijazah')->nullable(); // path ke file scan ijazah
            $table->text('keterangan')->nullable();
            $table->boolean('status_verifikasi')->default(false);
            $table->date('tanggal_terbit');
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
        Schema::dropIfExists('ijazahs');
    }
};
