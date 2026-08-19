<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        
        DB::table('users')->where('role', 'user')->update(['role' => 'customer']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });
    }
};