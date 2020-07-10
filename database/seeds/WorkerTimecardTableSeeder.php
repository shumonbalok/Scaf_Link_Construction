<?php

use Illuminate\Database\Seeder;

class WorkerTimecardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workers = DB::table('workers')->get();
        $projects = DB::table('projects')->get();
        $departments = DB::table('departments')->get();
        
    	foreach ($workers as  $worker){ 
            
            for ($i=1; $i < 31; $i++) { 
                DB::table('worker_timecards')->insert([
                    'worker_id' => $worker->id,
                    'normal_hrs' => (int)8,
                    'ot_hrs' => rand(2, 4),
                    'project_id' => rand(1, $projects->count()),
                    'department_id' => rand(1, $departments->count()),
                    'supervisor_status' => 1,
                    'manager_status' => 1,
                    'created_at' => '2020-0'. rand(1, 4) .'-'. $i. ' 05:46:42',
                    'updated_at' => '2020-0'. rand(1, 4) .'-'. $i. ' 05:46:42',
                ]);
            }	
    	}
    }
}
