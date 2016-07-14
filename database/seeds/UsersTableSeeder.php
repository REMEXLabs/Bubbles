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
                'name'        => 'nok',
                'email'       => 'morawiec@hdm-stuttgart.de',
                'password'    => Hash::make('pw'),
                // 'confirmed'   => 1,
		            // 'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
            ),
            array(
                'name'        => 'admin',
                'email'       => 'admin@hdm-stuttgart.de',
                'password'    => Hash::make('p4all'),
                // 'confirmed'   => 1,
		            // 'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
            ),
        );
        DB::table('users')->insert($users);
    }
}
