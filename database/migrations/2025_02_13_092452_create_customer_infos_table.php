<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('vendor_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('create_config')->nullable();
            $table->string('config_time')->nullable();
            $table->integer('creator_id')->nullable();
            $table->string('creator_name')->nullable();
            $table->string('creator_email')->nullable();
            $table->integer('pack_id')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_infos');
    }
};
