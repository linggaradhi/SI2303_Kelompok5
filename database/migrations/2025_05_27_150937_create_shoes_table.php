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
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('merk');
            $table->string('warna')->nullable();
            $table->string('tipe')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('layanan'); // Contoh: "biasa", "deep clean"
            $table->decimal('harga', 10, 2)->default(0);
            $table->timestamps();
            // $table->unsignedBigInteger('service_id');
            // $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoes');
    }
};
