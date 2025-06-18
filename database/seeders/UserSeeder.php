<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'id_pengguna' => '29001',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // $users = [
        //     [
        //         'name' => 'Operator 1',
        //         'email' => 'operator1@arsipijazah.com',
        //         'password' => Hash::make('operator123'),
        //         'role' => 'operator'
        //     ],
        //     [
        //         'name' => 'Viewer 1',
        //         'email' => 'viewer1@arsipijazah.com',
        //         'password' => Hash::make('viewer123'),
        //         'role' => 'viewer'
        //     ],
        // ];

        // foreach ($users as $user) {
        //     User::create($user);
        // }

        $this->command->info('User admin dan contoh user lainnya berhasil dibuat!');
        $this->command->warn('Email: admin@arsipijazah.com');
        $this->command->warn('id pengguna: 29001');
        $this->command->warn('Password: password123');
    }
}
