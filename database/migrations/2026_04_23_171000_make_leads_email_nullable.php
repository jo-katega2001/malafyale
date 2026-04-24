<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leads') || ! Schema::hasColumn('leads', 'email')) {
            return;
        }

        $this->rebuildLeadsTable(emailNullable: true);
    }

    public function down(): void
    {
        if (! Schema::hasTable('leads') || ! Schema::hasColumn('leads', 'email')) {
            return;
        }

        DB::table('leads')
            ->whereNull('email')
            ->update(['email' => '']);

        $this->rebuildLeadsTable(emailNullable: false);
    }

    private function rebuildLeadsTable(bool $emailNullable): void
    {
        Schema::withoutForeignKeyConstraints(function () use ($emailNullable): void {
            Schema::dropIfExists('leads_temp');

            Schema::create('leads_temp', function (Blueprint $table) use ($emailNullable): void {
                $table->id();
                $table->string('name', 120);
                $table->string('occupation')->nullable();
                $table->string('location')->nullable();
                $table->string('email')->nullable($emailNullable)->index();
                $table->string('phone', 30)->nullable();
                $table->string('instagram', 120)->nullable();
                $table->string('interest')->nullable();
                $table->string('source', 60)->default('website');
                $table->string('status', 20)->default('new')->index();
                $table->json('metadata')->nullable();
                $table->timestamps();
            });

            DB::table('leads_temp')->insertUsing(
                [
                    'id',
                    'name',
                    'occupation',
                    'location',
                    'email',
                    'phone',
                    'instagram',
                    'interest',
                    'source',
                    'status',
                    'metadata',
                    'created_at',
                    'updated_at',
                ],
                DB::table('leads')->select(
                    'id',
                    'name',
                    'occupation',
                    'location',
                    'email',
                    'phone',
                    'instagram',
                    'interest',
                    'source',
                    'status',
                    'metadata',
                    'created_at',
                    'updated_at',
                )
            );

            Schema::drop('leads');
            Schema::rename('leads_temp', 'leads');
        });
    }
};
