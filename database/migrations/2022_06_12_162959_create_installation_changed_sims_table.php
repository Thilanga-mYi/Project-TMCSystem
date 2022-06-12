<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationChangedSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installation_changed_sims', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('installation_id');
            $table->integer('changed_sim_id');
            $table->integer('new_sim_id');
            $table->double('sim_amount')->default(0);
            $table->double('additional_amount')->default(0);
            $table->string('remark')->nullable();
            $table->double('total_amount')->default(0);
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
        Schema::dropIfExists('installation_changed_sims');
    }
}
