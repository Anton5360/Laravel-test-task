<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param int $departmentsCount
     * @param int $employeeCount
     */
    public function run(int $departmentsCount = 10, int $employeeCount = 100): void
    {
        Department::factory($departmentsCount)->create();
        Employee::factory($employeeCount)->create();
    }
}
