<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        // Create sample customer
        User::create([
            'name' => 'Leaya',
            'email' => 'leaya@example.com',
            'password' => bcrypt('12345'),
            'role' => 'customer',
        ]);

        // Create services
        Service::create([
            'name' => 'Home Decorating',
            'description' => 'Professional home decorating service',
            'price' => 5000.00,
        ]);

        Service::create([
            'name' => 'Massage',
            'description' => '60-minute full body massage',
            'price' => 600.00,
        ]);

        Service::create([
            'name' => 'Car Wash',
            'description' => 'Full service car wash',
            'price' => 250.00,
        ]);
    }
}
