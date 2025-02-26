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
        Schema::table('customer_assigns', function (Blueprint $table) {
            //
            $table->integer('customer_id')->nullable();   
            $table->integer('user_id')->nullable();
            $table->integer('role')->nullable(); 
            $table->integer('service_id')->nullable(); 
            $table->integer('creator')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_assigns', function (Blueprint $table) {
            //
        });
    }
};
