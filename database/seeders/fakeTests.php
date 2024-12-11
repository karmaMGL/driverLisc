<?php

namespace Database\Seeders;

use App\Models\question;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class fakeTests extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($repeat = 0;$repeat<10;$repeat++){
            $correctAnswer = Str::random(10);
            $options = [];
            for($i = 0;$i<3;$i++){
                $options[] = Str::random(6);
            }
            $options[] = $correctAnswer;
            DB::table('questions')->insert([
                'SectionIDSelected'=>rand(1,Section::count()),
                'Title'=>Str::random(10),
                'Options'=>json_encode($options),
                'CorrectAnswer'=>$correctAnswer,
                'why'=>'idk'
            ]);
        }
    }
}
