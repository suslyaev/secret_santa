<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Pair;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        function getSantaId($id, $arr) {
            $rand = $arr[array_rand($arr)]; 
            if ($id == $rand || $rand <= 0 || !is_numeric($rand)) {
                return getSantaId($id, $arr);
            } else {
                return $rand;
            }
        }

        Person::factory()->count(5)->create();
        $persons = Person::all();
        
        $arr = array(); 

        foreach ($persons as $person) {
            if ($person->id != null) {
                array_push($arr, $person->id);
            }
        }

        $arr_new = $arr;


        foreach ($arr as $a) {
            $pair = new Pair;
            $pair->people_id = $a;
            $rand = getSantaId($a, $arr_new);
            $pair->santa_id = $rand;
            $pair->save();
            unset($arr_new[array_search($rand, $arr_new)]);
        }
    }
}
