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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('bookings')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['Xendit', 'Cash']);
            $table->string('link_pembayaran')->nullable();
            $table->date('tanggal_pemesanan');
            $table->decimal('jumlah_pembayaran', 10, 2);
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
        Schema::dropIfExists('payments');
    }
};
