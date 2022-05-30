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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timeout');
            $table->string('address');
            $table->string('regency');
            $table->string('province');
            $table->double('total', 9, 2);
            $table->double('shipping_cost', 9, 2);
            $table->double('sub_total', 9, 2);
            $table->bigInteger('user_id');
            $table->bigInteger('courier_id');
            $table->string('proof_of_payment')->nullable();
            $table->enum('status', ['Telah Sampai', 'Dalam Pengiriman', 'Dibatalkan', 'Belum Terbayar', 'Pending', 'Expired']);            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
