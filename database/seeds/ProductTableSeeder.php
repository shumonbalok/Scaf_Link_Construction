<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('categories')->get()->pluck('id');
        $departments = DB::table('departments')->get();
        $names = ['Gi nikol', 'Molipos', 'Demone', 'Kelokd'];
        
    	foreach ($departments as  $department){ 
            
            for ($i=0; $i < 9; $i++) { 
                DB::table('products')->insert([
                    'name' => $names[rand(0, 3)].'-'.$department->name,
                    'pdt_code' => rand(100,300),
                    'wight' => rand(10, 100),
                    'barcode' => rand(1050, 3600),
                    'category_id' => rand(0, $categories->count()),
                    'department_id' => $department->id,
                    'total' => rand(10, 100),
                    'alertQty' => rand(10, 20),
                    'image' => 'products/demo.jpg',
                    'size' => rand(1, 6),
                    'status' => 1,
                    'descp' => $department->name.' Larium spame silivas make sure to place composer\'s system-wide vendor bin directory in your $PATH so the laravel executable can be located by your system. This directory exists in different locations based on your operating system; however, some common locations include',
                    'created_at' => '2020-'. rand(1, 8) .'-'. ($i + 1). ' 05:46:42',
                    'updated_at' => '2020-'. rand(1, 8) .'-'. ($i + 1). ' 05:46:42',
                ]);
            }	
    	}
    }
}

