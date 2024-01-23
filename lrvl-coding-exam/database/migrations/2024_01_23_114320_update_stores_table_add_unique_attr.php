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
        Schema::table('stores', function (Blueprint $table) {
            //
            $table->string('store_phone_number')->unique()->change();
            $table->string('store_email')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('stores', function (Blueprint $table) {
            $table->dropUnique(['store_phone_number']);
            $table->dropUnique(['store_email']);
        });
    }
};
