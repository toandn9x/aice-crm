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
        Schema::create('customer_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('action_type')->nullable();
            $table->text('old_value')->nullable(); // Giá trị cũ (JSON nếu cần)
            $table->text('new_value')->nullable(); // Giá trị mới (JSON nếu cần)
            $table->integer('updater')->nullable();
            $table->text('note')->nullable(); // Ghi chú về thay đổi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_histories');
    }
};
