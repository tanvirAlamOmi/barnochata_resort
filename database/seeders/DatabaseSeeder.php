<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $passSystem = 'Aa@123456';
        $userSystem = User::create([
            'name' => 'System Admin',
            'email' => 'system.admin@yopmail.com',
            'mobile_no' => '01816389710',
            'type' => 'system',
            'weight' => 99.99,
            'status' => true,
            'password' => bcrypt($passSystem),
        ]);

        $passAdmin = 'aA@123456';
        $userAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'mobile_no' => '01789456123',
            'type' => 'admin',
            'weight' => 50,
            'status' => true,
            'password' => bcrypt($passAdmin),
        ]);
    }
}
