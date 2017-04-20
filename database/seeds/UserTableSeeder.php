<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = \App\User::firstOrNew([
            'email' => 'root@email.com',
        ]);

        $root->name = 'Root';
        $root->password = bcrypt('root');
        $root->status = 'active';

        $root->assign('root');

        $users = factory(\App\User::class, 50)->create();
    }
}
