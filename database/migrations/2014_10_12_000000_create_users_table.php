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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->integer('otp')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('suspend')->nullable()->default(false);
            // ========================================== //
            $table->string('area')->nullable();
            $table->string('id_number')->nullable();
            $table->bigInteger('employer_id')->default(false);
            $table->string('employer_name')->nullable();
            $table->string('employer_years')->nullable();
            $table->string('salary')->nullable();
            // ========================================== //
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('employers');
    }
};
