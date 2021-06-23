<?php

use App\Task;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            ['id'=>Str::uuid(),'description'=>'Wash the car at the saturday','completed'=>false],
            ['id'=>Str::uuid(),'description'=>'Make a best code for application','completed'=>true],
            ['id'=>Str::uuid(),'description'=>'Test a new application','completed'=>false],
            ['id'=>Str::uuid(),'description'=>'Give a cat food','completed'=>false],
            ['id'=>Str::uuid(),'description'=>'Stay calm and solve the all problems', 'completed'=>false],
            ['id'=>Str::uuid(),'description'=>'Stay home every day cause the pandemics', 'completed'=>false],
            ['id'=>Str::uuid(),'description'=>'Do something well', 'completed'=>true]
        ]);
    }
}
