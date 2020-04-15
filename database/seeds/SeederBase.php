<?php

use Illuminate\Database\Seeder;

class SeederBase extends Seeder
{
    public function loadData(string $fileName) : array
    {
        try 
        {
            $fileContent = file_get_contents(database_path("seeds/data/{$fileName}.json"));
        
            return json_decode($fileContent, true);
        }
        catch (exception $e) 
        {
            die("Error loading {$fileName}.json\n");
        }
    }
}
