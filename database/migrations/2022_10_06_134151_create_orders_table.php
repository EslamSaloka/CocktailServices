<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('bank_id')->index();
            $table->unsignedBigInteger('service_id')->index();
            // ============================ //
            $table->string('account_name')->nullable();
            $table->string('person_any')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('transfer_number')->nullable();
            $table->string('transfer_image')->nullable();
            $table->float('transfer_price')->default(0);
            $table->boolean('seen')->default(0);
            $table->integer('action')->default(0);
            $table->timestamps();
            // ============================ //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        Schema::create('order_entities_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('entities_id')->index();
            // ============================ //
            $table->timestamps();
            // ============================ //
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('entities_id')->references('id')->on('entities')->onDelete('cascade');
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
        Schema::dropIfExists('order_entities_pivot');
    }
};
