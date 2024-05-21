<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ['id' => 1, 'name' => 'Super Admin', 'email_verified_at' => now(), 'email' => 'admin@admin.com', 'password' => Hash::make('password'), 'type' => 'admin'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['id' => $user['id']], $user);
        }
    }
}
