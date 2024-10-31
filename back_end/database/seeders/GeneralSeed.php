<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class GeneralSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createGrades();
        $this->createStudents();


    }


    protected function createGrades()
    {
        foreach (Grade::GRADES as $grade  ){
            Grade::create([
                'grade'=> $grade,
            ]);
        }
    }


    protected function createStudents()
    {
            Student::create([
                'name'=> 'Carlos Castro',
                'father_name'=> 'Luis Castro',
                'mother_name'=> 'Daniela Ruiz',
                'section'=> 'Diurna',
                'grade_id'=> 5,
                'date_entry'=> Carbon::parse('2020-10-30'),
                'born_date'=> Carbon::parse('2014-10-30'),

            ]);

    }
}
