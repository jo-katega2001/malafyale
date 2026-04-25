<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        $email = 'admin@mwalafyale.com';
        $now = now();

        $attributes = [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
            'updated_at' => $now,
        ];

        $adminExists = DB::table('users')->where('email', $email)->exists();

        if ($adminExists) {
            DB::table('users')->where('email', $email)->update($attributes);

            return;
        }

        DB::table('users')->insert([
            'email' => $email,
            'created_at' => $now,
            ...$attributes,
        ]);
    }

    public function down(): void
    {
        //
    }
};
