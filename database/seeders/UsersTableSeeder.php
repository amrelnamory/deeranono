<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =
            [
                [
                    'name' => 'عمرو النموري',
                    'job' => 'مهندس برمجيات',
                    'address' => 'مصر - المحلة الكبرى',
                    'email' => 'amro.elnamory94@gmail.com',
                    'phone' => '01065019583',
                    'password' => bcrypt('123456'),
                ],
                 
            ];

        foreach ($users as $user) {
            $single_user = User::create($user);
            $single_user->attachRole('super_admin');
        }
    } // End of Run

} // End of Seeder
