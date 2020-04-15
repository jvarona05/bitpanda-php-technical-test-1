<?php

class UserSeeder extends SeederBase
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = $this->loadData('users');

        DB::table('users')->insert($users);
    }
}
