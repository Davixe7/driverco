<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Role::create(['name'=>'admin']);
        // Role::create(['name'=>'user']);

        $admin = \App\Models\User::create([
          'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
            'phone' => '4147942833'
        ]);

        $admin->assignRole('admin');

        \App\Models\User::create([
          'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt(123456),
            'phone' => '4147912134'
        ]);

        \App\Models\Vehicle::factory(100)->create();
    }
}
