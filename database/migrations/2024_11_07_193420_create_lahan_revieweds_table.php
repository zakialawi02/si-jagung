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
        Schema::create('lahan_revieweds', function (Blueprint $table) {
            $table->id();
            $table->uuid('lahan_kebun_id');
            $table->boolean('reviewed')->default(0);
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreign('lahan_kebun_id')->references('id')->on('lahan_kebuns')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan_revieweds');
    }
};
