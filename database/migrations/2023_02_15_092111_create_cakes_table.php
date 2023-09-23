<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cakes', function (Blueprint $table) {
            $table->id();
            $table->string('cake_name', 255);
            $table->string('cake_price', 255);
            $table->string('cake_description', 255);
            $table->foreignId('category_id')->default(0)->constrained()->cascadeOnDelete();
            $table->longText('cake_url');
            $table->longText('img_name');
            $table->longText('cake_details');
            $table->enum('statsus', [1, 0])->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('current_timestamp'));
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on  update current_timestamp'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cakes');
    }
}