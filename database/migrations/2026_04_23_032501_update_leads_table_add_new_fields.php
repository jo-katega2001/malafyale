<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('occupation')->nullable()->after('name');
            $table->string('location')->nullable()->after('occupation');
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('instagram', 120)->nullable()->after('phone');
            $table->string('status', 20)->default('new')->index()->after('source');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['occupation', 'location', 'phone', 'instagram', 'status']);
        });
    }
};
