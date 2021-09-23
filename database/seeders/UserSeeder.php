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
        app('db')->table('users')
            ->insert([
                'name' => 'admin',
                'password' => password_hash('12345', PASSWORD_DEFAULT), //must change it with the first login
                'email' => 'admin@redirect',
                "is_admin" => true
            ]);
    }
}
