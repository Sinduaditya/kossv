<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('id_kamar')->constrained('rooms')->onDelete('cascade');
            $table->date('tanggal_pemesanan');
            $table->date('tanggal_berakhir');
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('kode_booking')->unique();
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
        Schema::dropIfExists('bookings');
    }
};
