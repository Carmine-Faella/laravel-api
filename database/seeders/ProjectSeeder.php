<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<10; $i++) {
            $newProject = new Project();
            $newProject->title = $faker->sentence(5);
            $newProject->content = $faker->text(100);
            $newProject->cover_image = 'https://picsum.photos/150/150';
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->save();
        }
    }
}
