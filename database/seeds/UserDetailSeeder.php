<?php

class UserDetailSeeder extends SeederBase
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDetails = $this->loadData('userDetails');

        DB::table('user_details')->insert($userDetails);
    }
}
