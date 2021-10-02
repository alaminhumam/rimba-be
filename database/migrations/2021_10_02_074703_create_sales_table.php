<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_code')->unique()->index();
            $table->datetime('transaction_date');
            $table->uuid('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('total_qty');
            $table->double('total_discount');
            $table->double('total_price');
            $table->double('total_pay');
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
        Schema::dropIfExists('sales');
    }
}
