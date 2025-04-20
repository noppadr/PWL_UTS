<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'user_id' => 1,
                'level_id' => 1,
                'username' => 'superadmin',
                'nama' => 'Super Administrator',
                'password' => Hash::make('SuperSecure123!'),
            ],
            [
                'user_id' => 2,
                'level_id' => 2,
                'username' => 'dept_manager',
                'nama' => 'Department Manager',
                'password' => Hash::make('ManagerPass456!'),
            ],
            [
                'user_id' => 3,
                'level_id' => 3,
                'username' => 'cashier01',
                'nama' => 'Front Desk Cashier',
                'password' => Hash::make('CashierSafe789!'),
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}
