<?php

use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users = array(
            array(
                'username'    => 'morawiec',
                'email'       => 'morawiec@hdm-stuttgart.de',
                'password'    => Hash::make('pw'),
                // 'confirmed'   => 1,
		            // 'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'admin',
                'email'       => 'admin@hdm-stuttgart.de',
                'password'    => Hash::make('pw'),
                // 'confirmed'   => 1,
		            // 'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
        );
        DB::table('users')->insert($users);
    }
}
