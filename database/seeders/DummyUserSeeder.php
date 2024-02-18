<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = 
        [
            [
                'name'=> 'Mas Operator',
                'email'=> 'operator@gmail.com',
                'role'=>'operator',
                'password'=>bcrypt('12345678')
            ],
            [
                'name'=> 'Mas kuangan',
                'email'=> 'keuangan@gmail.com',
                'role'=>'keuangan',
                'password'=>bcrypt('12345678')
            ],
            [
                'name'=> 'ahmadfadli',
                'email'=> 'ahmadfadli@gmail.com',
                'role'=>'marketing',
                'password'=>bcrypt('12345678')
            ],
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
