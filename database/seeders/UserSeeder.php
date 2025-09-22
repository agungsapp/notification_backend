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
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'spv',
                'email' => 'spv@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'spv',
            ],
            [
                'name' => 'pegawai',
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'pegawai',
            ],
        ];

        foreach ($data as $item) {
            User::create($item);
        }
    }
}
