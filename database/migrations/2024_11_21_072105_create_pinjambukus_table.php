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
        Schema::create('pinjambukus', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relasi ke tabel books
            $table->date('tanggal_pinjam'); // Tanggal peminjaman
            $table->date('tanggal_kembali')->nullable(); // Tanggal pengembalian (opsional)
            $table->string('status')->default('borrowed'); // Status peminjaman
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjambukus');
    }
};
