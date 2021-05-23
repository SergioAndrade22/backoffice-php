<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeRole = [3, 1, 1, 2, 1];
        $employeeName = ['Pepe', 'Luis', 'Carlos', 'Daina', 'Lucía'];
        $employeeSurname = ['AA', 'AA', 'AA', 'AA', 'AA'];
        $employeeUser = [1, 2, 3, 4, 5];
        for ($i = 0; $i < 5; $i++){
            Employee::create(
                array(
                    'employee_role_id' => $employeeRole[$i],
                    'first_name' => $employeeName[$i],
                    'last_name' => $employeeSurname[$i],
                    'user_id' => $employeeUser[$i],
                )
            );
        }
    }
}
