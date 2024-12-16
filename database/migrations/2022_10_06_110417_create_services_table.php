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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price')->default(0);
            $table->timestamps();
        });

        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('whatsapp')->nullable();
            $table->timestamps();
        });

        Schema::create('entitle_services_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entitle_id')->index();
            $table->unsignedBigInteger('service_id')->index();
            $table->timestamps();
            $table->foreign('entitle_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('count');
            $table->timestamps();
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('iban')->nullable();
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
        Schema::dropIfExists('entitle_services_pivot');
        Schema::dropIfExists('services');
        Schema::dropIfExists('entities');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('counters');
        Schema::dropIfExists('banks');
    }
};
