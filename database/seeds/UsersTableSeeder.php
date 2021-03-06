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

        // Admins:
        $users = array(
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
            array(
                'username'    => 'darius',
                'email'       => 'darius@hdm-stuttgart.de',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'anna',
                'email'       => 'anna@hdm-stuttgart.de',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'andrea',
                'email'       => 'andrea@example.com',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'test_user_1',
                'email'       => 'test_user_1@example.com',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'test_user_2',
                'email'       => 'test_user_2@example.com',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
            array(
                'username'    => 'test_user_3',
                'email'       => 'test_user_3@example.com',
                'password'    => Hash::make('pw'),
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
                'role'        => 'admin',
            ),
        );
        foreach ($users as $key => $user) {
            $user = new App\User($user);
            $user->save();
            for ($idx=0, $len=mt_rand(1, 4); $idx<$len; $idx++) {
                $user->projects()->save(factory(App\Project::class)->make());
            }
            for ($idx=0, $len=mt_rand(2, 5); $idx<$len; $idx++) {
                $user->quests()->save(factory(App\Quest::class)->make());
            }
        }
        // DB::table('users')->insert($users);

        // Users:
        factory(App\User::class, mt_rand(10, 20))->create()->each(function ($user) {
            for ($idx=0, $len=mt_rand(1, 4); $idx<$len; $idx++) {
                $user->projects()->save(factory(App\Project::class)->make());
            }
            for ($idx=0, $len=mt_rand(2, 5); $idx<$len; $idx++) {
                $user->quests()->save(factory(App\Quest::class)->make());
            }
        });
    }
}
