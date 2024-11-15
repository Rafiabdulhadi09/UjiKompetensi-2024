<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
            'name'=>'admin',
            'username'=>'admin',
            'role'=>'admin',
            'password'=>bcrypt('123')
            ],
            [
            'name'=>'kasir',
            'username'=>'kasir',
            'role'=>'kasir',
            'password'=>bcrypt('123')
            ],
            [
            'name'=>'owner',
            'username'=>'owner',
            'role'=>'owner',
            'password'=>bcrypt('123')
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
