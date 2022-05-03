<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('installation_type');
            $table->string('invoice_code');
            $table->double('annual_fee');
            $table->double('travelling_fee')->nullable();
            $table->integer('warranty_id');
            $table->integer('payment_type_id');
            $table->integer('installed_by_id');
            $table->string('hand_bill_number')->nullable();
            $table->string('vehicle_plate_number')->nullable();
            $table->double('vehicle_milage')->nullable();
            $table->string('vehicle_modal')->nullable();
            $table->double('engine_hours_h')->nullable();
            $table->double('engine_hours_m')->nullable();
            $table->integer('sim_card_id');
            $table->integer('product_id');
            $table->integer('device_model_id');
            $table->longText('remark')->nullable();
            $table->string('admin_in_use')->nullable();
            $table->string('admin_numbers')->nullable();
            $table->integer('job_referance')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->longText('nic_front_img')->nullable();
            $table->longText('nic_back_img')->nullable();
            $table->longText('vehicle_img1')->nullable();
            $table->longText('vehicle_img2')->nullable();
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
        Schema::dropIfExists('installations');
    }
}
