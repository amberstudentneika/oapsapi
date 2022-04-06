<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackeVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracke_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignID('eVoucherPaymentDetailsID')->constrained('e_voucher_payment_details','id');
            $table->foreignID('canteenStaffID')->constrained('canteen_staff','id')->nullable;
            $table->BigInteger('RemainingUsage')->unsigned();
            $table->date('date');
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('tracke_vouchers');
    }
}
