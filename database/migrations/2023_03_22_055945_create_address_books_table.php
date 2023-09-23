<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->string("reciever_name",255);
            $table->foreignId('user_id')->default(0)->constrained()->cascadeOnDelete();
            $table->string("delivery_city",255);
            $table->string("pinCode",255);
            $table->string("delivery_address",255);
            $table->string("shipping_number",255);
            $table->string("addtype",255);
            $table->enum('status',[0,1])->default(1);
            $table->softDeletes();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
        Schema::dropIfExists('address_books');
    }
}
