<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEVoucherPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_voucher_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignID('RelationshipID')->constrained('relationships','id');
            $table->string('type')->default('Card');
            $table->float('totalCost',10,2);
            $table->float('amountPaid',10,2);
            $table->string('nameOnCard');
            $table->string('cardNum');
            $table->string('expDate');
            $table->string('secCode');
            $table->BigInteger('totalAllotment')->unsigned();
            $table->string('voucherNumber');
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
        Schema::dropIfExists('e_voucher_payment_details');
    }
}
