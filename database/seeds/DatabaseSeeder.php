<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Model::unguard();
        //$this->call(ProductTableSeeder::class);
        //$this->call(WorkerTimecardTableSeeder::class);
        //$this->call(StaffSalariesTableSeeder::class);
    }
}
