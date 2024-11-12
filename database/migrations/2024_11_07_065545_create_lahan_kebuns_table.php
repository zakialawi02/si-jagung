<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lahan_kebuns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('no_kebun')->nullable();
            $table->string('nama_pemilik');
            $table->float('luas', 25, 6)->nullable();
            $table->float('jumlah_produksi', 25, 3)->nullable();
            $table->string('jenis_jagung');
            $table->string('varietas_jagung')->nullable();
            $table->string('kontak')->nullable();
            $table->geometry('geom', 4326);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan_kebuns');
    }
};
