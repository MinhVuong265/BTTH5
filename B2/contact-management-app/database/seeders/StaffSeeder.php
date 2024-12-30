<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Department;
use Database\Factories\StaffFactory;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        Staff::factory()->count(50)->create([
        'department_id' => function () use ($departments) {
            return $departments->random()->id;
        },
    ]);

    }
}
