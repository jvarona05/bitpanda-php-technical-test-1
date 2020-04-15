<?php

class CountrySeeder extends SeederBase
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = $this->loadData('countries');

        DB::table('countries')->insert($countries);
    }
}
