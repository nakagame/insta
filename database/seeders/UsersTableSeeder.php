<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $users = [
            [
                'name'       => 'Admin',
                'email'      => 'admin@admin.com',
                'password'   => Hash::make('password'),
                'role_id'    => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'John Doe',
                'email'      => 'john@gmail.com',
                'password'   => Hash::make('password'),
                'role_id'    => 2,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name'       => 'Ema Wastson',
                'email'      => 'ema@gmail.com',
                'password'   => Hash::make('password'),
                'role_id'    => 2,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name'       => 'Harry Poter',
                'email'      => 'harry@gmail.com',
                'password'   => Hash::make('password'),
                'role_id'    => 1,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name'       => 'Kevin Test',
                'email'      => 'kevin@gmail.com',
                'password'   => Hash::make('password'),
                'role_id'    => 2,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        ];

        $this->user->insert($users);
    }
}
