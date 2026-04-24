<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->string('url', 2048);
            $table->string('referrer', 2048)->nullable();
            $table->timestamp('visited_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
