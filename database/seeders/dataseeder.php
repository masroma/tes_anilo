<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class dataseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=1; $i<= 250; $i++){
            $score = [
                [
                    'student_id' => Student::all()->random()->id,
                    'subject_id' => Subject::all()->random()->id,
                    'score' => rand(70,98),
                    'created_at' => new \DateTime,
                    'updated_at' => null,
                ],
            ];
            \DB::table('scores')->insert($score);
        }

    }
}
