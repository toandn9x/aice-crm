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
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->string('representative')->nullable();         // Đại diện
            $table->date('operating_day')->nullable();            // Ngày hoạt động
            $table->string('tax_department')->nullable();         // Cơ quan thuế
            $table->string('main_profession')->nullable();        // Ngành nghề chính
            $table->string('status_of_business')->nullable();     // Trạng thái kinh doanh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_infos', function (Blueprint $table) {
            //
        });
    }
};
