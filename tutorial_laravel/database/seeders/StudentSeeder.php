<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Student::truncate();
        // Schema::enableForeignKeyConstraints();

        // $data = [
        //     ['name' => 'richard', 'gender' => 'L', 'nis' => '0001', 'class_id' => '2'],
        //     ['name' => 'ariq', 'gender' => 'L', 'nis' => '0002', 'class_id' => '1'],
        //     ['name' => 'Saras', 'gender' => 'P', 'nis' => '0003', 'class_id' => '2'],
        //     ['name' => 'Fulan', 'gender' => 'P', 'nis' => '0004', 'class_id' => '1'],
        //     ['name' => 'Albert', 'gender' => 'L', 'nis' => '0005', 'class_id' => '1'],
        // ];

        // foreach ($data as $value){
        //     Student::insert([
        //         'name' => $value['name'],
        //         'gender' => $value['gender'],
        //         'nis' => $value['nis'],
        //         'class_id' => $value['class_id'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
            
        // }

        Student::factory()->count(20)->create();
    }
}
