<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
        \DB::table('users')->insert($user);
    }
}
