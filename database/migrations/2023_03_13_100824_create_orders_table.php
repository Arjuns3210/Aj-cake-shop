<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fname',255);
            $table->string('lname',255);
            $table->string('payment_amount',255);
            // $table->string('payment_type',255);
            $table->string('email',255)->nullable();
            $table->string('address',255);
            $table->string('country',255);
            $table->string('state',255);
            $table->string('zip',255);
            $table->string('sameAdd',255)->nullable();
            $table->string('saveInfo',255)->nullable();
            $table->enum('status',[0,1])->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
