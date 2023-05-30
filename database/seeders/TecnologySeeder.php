<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tecnology;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techs = ['ChatGPT','Artificial Intelligence','Programming Innovation'];

        foreach($techs as $tech){
            $newTech = new Tecnology;
            $newTech->name_tech = $tech;
            $newTech->slug = Str::slug($tech, '-');
            $newTech->save();
        }
    }
}
