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
        Schema::create('pemasukkans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('sumber_pemasukkan');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah');
            $table->date('tanggal_pemasukkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukkans');
    }
};
