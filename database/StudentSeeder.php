<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['student_id' => '2411600101', 'first_name' => 'Maria', 'last_name' => 'Santos', 'email' => 'maria.santos@student.edu', 'course' => 'BSIT', 'year_level' => '3rd Year', 'grade' => 92.50, 'status' => 'Active', 'remarks' => 'Dean\'s Lister'],
            ['student_id' => '2411600102', 'first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'email' => 'juan.delacruz@student.edu', 'course' => 'BSIT', 'year_level' => '2nd Year', 'grade' => 85.00, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600103', 'first_name' => 'Ana', 'last_name' => 'Reyes', 'email' => 'ana.reyes@student.edu', 'course' => 'BSCS', 'year_level' => '4th Year', 'grade' => 96.75, 'status' => 'Active', 'remarks' => 'Magna Cum Laude candidate'],
            ['student_id' => '2411600104', 'first_name' => 'Carlo', 'last_name' => 'Garcia', 'email' => 'carlo.garcia@student.edu', 'course' => 'BSIT', 'year_level' => '1st Year', 'grade' => 78.25, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600105', 'first_name' => 'Sofia', 'last_name' => 'Lopez', 'email' => 'sofia.lopez@student.edu', 'course' => 'BSIS', 'year_level' => '3rd Year', 'grade' => 58.00, 'status' => 'Active', 'remarks' => 'Needs tutoring'],
            ['student_id' => '2411600106', 'first_name' => 'Miguel', 'last_name' => 'Torres', 'email' => 'miguel.torres@student.edu', 'course' => 'BSCS', 'year_level' => '2nd Year', 'grade' => 88.50, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600107', 'first_name' => 'Isabella', 'last_name' => 'Cruz', 'email' => 'isabella.cruz@student.edu', 'course' => 'BSBA', 'year_level' => '4th Year', 'grade' => 91.00, 'status' => 'Active', 'remarks' => 'Scholarship recipient'],
            ['student_id' => '2411600108', 'first_name' => 'Diego', 'last_name' => 'Ramos', 'email' => 'diego.ramos@student.edu', 'course' => 'BSIT', 'year_level' => '3rd Year', 'grade' => 45.50, 'status' => 'Incomplete', 'remarks' => 'Missing final project'],
            ['student_id' => '2411600109', 'first_name' => 'Camila', 'last_name' => 'Flores', 'email' => 'camila.flores@student.edu', 'course' => 'BSED', 'year_level' => '2nd Year', 'grade' => 82.00, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600110', 'first_name' => 'Luis', 'last_name' => 'Mendoza', 'email' => 'luis.mendoza@student.edu', 'course' => 'BSCE', 'year_level' => '1st Year', 'grade' => 74.25, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600111', 'first_name' => 'Elena', 'last_name' => 'Navarro', 'email' => 'elena.navarro@student.edu', 'course' => 'BSCS', 'year_level' => '3rd Year', 'grade' => 94.00, 'status' => 'Active', 'remarks' => 'Programming contest winner'],
            ['student_id' => '2411600112', 'first_name' => 'Andres', 'last_name' => 'Vargas', 'email' => 'andres.vargas@student.edu', 'course' => 'BSIT', 'year_level' => '4th Year', 'grade' => 67.50, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600113', 'first_name' => 'Lucia', 'last_name' => 'Jimenez', 'email' => 'lucia.jimenez@student.edu', 'course' => 'BSIS', 'year_level' => '2nd Year', 'grade' => 55.00, 'status' => 'Active', 'remarks' => 'At risk of failing'],
            ['student_id' => '2411600114', 'first_name' => 'Pablo', 'last_name' => 'Morales', 'email' => 'pablo.morales@student.edu', 'course' => 'BSEE', 'year_level' => '3rd Year', 'grade' => 89.75, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600115', 'first_name' => 'Valentina', 'last_name' => 'Ortiz', 'email' => 'valentina.ortiz@student.edu', 'course' => 'BSBA', 'year_level' => '1st Year', 'grade' => 81.50, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600116', 'first_name' => 'Rafael', 'last_name' => 'Silva', 'email' => 'rafael.silva@student.edu', 'course' => 'BSIT', 'year_level' => '2nd Year', 'grade' => null, 'status' => 'Incomplete', 'remarks' => 'Leave of absence'],
            ['student_id' => '2411600117', 'first_name' => 'Gabriel', 'last_name' => 'Santos', 'email' => 'gabriel.santos@student.edu', 'course' => 'BSIT', 'year_level' => '3rd Year', 'grade' => 90.25, 'status' => 'Active', 'remarks' => 'Lab 5 author'],
            ['student_id' => '2411600118', 'first_name' => 'Martina', 'last_name' => 'Castro', 'email' => 'martina.castro@student.edu', 'course' => 'BSCS', 'year_level' => '4th Year', 'grade' => 98.00, 'status' => 'Active', 'remarks' => 'Summa Cum Laude candidate'],
            ['student_id' => '2411600119', 'first_name' => 'Sebastian', 'last_name' => 'Reyes', 'email' => 'sebastian.reyes@student.edu', 'course' => 'BSCE', 'year_level' => '2nd Year', 'grade' => 72.00, 'status' => 'Active', 'remarks' => null],
            ['student_id' => '2411600120', 'first_name' => 'Daniela', 'last_name' => 'Gutierrez', 'email' => 'daniela.gutierrez@student.edu', 'course' => 'BSED', 'year_level' => '3rd Year', 'grade' => 86.50, 'status' => 'Active', 'remarks' => null],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
