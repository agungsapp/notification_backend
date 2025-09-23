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
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'position' => 'owner',
                'supervisor_id' => null,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'position' => 'hrd',
                'supervisor_id' => 1,
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'manager',
                'position' => 'manager',
                'supervisor_id' => 2,
            ],
            [
                'name' => 'pic',
                'email' => 'pic@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'employee',
                'position' => 'pic',
                'supervisor_id' => 3,
            ],
            [
                'name' => 'pegawai',
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'employee',
                'position' => 'staff',
                'supervisor_id' => 3,
            ],
        ];

        foreach ($data as $item) {
            if ($item['position'] == 'staff') {
                for ($i = 1; $i <= 10; $i++) {
                    User::create([
                        'name' => 'pegawai' . $i,
                        'email' => 'pegawai' . $i . '@gmail.com',
                        'password' => Hash::make('admin123'),
                        'role' => 'employee',
                        'position' => 'staff',
                        'supervisor_id' => 3,
                    ]);
                }
            } else {
                User::create($item);
            }
        }
    }
}
