<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->string('grn_code');
            $table->integer('user_id');
            $table->integer('supplier_id')->nullable();
            $table->integer('grn_type_id');
            $table->integer('warehouse_id');
            $table->string('po_ref')->nullable();
            $table->string('logistic_name')->nullable();
            $table->double('logistic_amount')->nullable();
            $table->string('logistic_ref')->nullable();
            $table->dateTime('logistic_paid_date')->nullable();
            $table->integer('vat_id');
            $table->double('total');
            $table->double('vat_value');
            $table->double('net_grn_total');
            $table->double('net_grn_total_with_logistic_amount');
            $table->double('tot_paid')->default(0);
            $table->double('tot_balance')->default(0);
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('grns');
    }
}
