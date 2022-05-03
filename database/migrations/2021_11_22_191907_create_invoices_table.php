<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code');
            $table->integer('order_type_id');
            $table->string('referance')->nullable();
            $table->integer('administration_id');
            $table->integer('warehouse_id');
            $table->double('total');
            $table->double('discount');
            $table->integer('vat_id');
            $table->double('net_total');
            $table->text('remark')->nullable();
            $table->text('billing_to')->nullable();
            $table->text('billing_address')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('invoices');
    }
}
