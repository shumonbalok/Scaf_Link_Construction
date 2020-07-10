<?php

use Illuminate\Database\Seeder;

class StaffSalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        
    	foreach ($users as  $user){
            
            for ($i=1; $i < 5; $i++) { 
                DB::table('staff_salaries')->insert([
                    'user_id' => $user->id,
                    'created_at' => '2020-'. $i .'-05 05:46:42',
                    'updated_at' => '2020-'. $i .'-05 05:46:42',
                ]);
            }
    	}
    }
}
