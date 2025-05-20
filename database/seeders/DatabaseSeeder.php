<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Camera;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Camera::create([
            'name' => 'Test',
            'url' => 'http://213.123.122.163:1087/axis-cgi/mjpg/video.cgi',
        ]);

        Camera::create([
            'name' => 'Test2',
            'url' => 'http://213.123.122.163:1087/axis-cgi/mjpg/video.cgi',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin1234',
            'is_admin' => true
        ]);

        User::create([
            'name' => 'tester 1',
            'email' => 'tester1@gmail.com',
            'password' => '1234'
        ]);

        User::create([
            'name' => 'tester 2',
            'email' => 'tester2@gmail.com',
            'password' => '4321'
        ]);
    }
}
