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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')->nullable();
            $table->string('nisn', 10)->unique();
            $table->string('nis', 10)->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('nama_orang_tua')->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->string('foto')->nullable();
            $table->year('angkatan')->nullable();
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
        Schema::dropIfExists('students');
    }
};
