<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //elimina tutti i dati all'interno della tabella
        Project::truncate();

        //inserisce dati finti (5 righe) 
        for($i= 0; $i < 5 ; $i++) { 

            Schema::disableForeignKeyConstraints();
            $type= Type::inRandomOrder()->first();
            Schema::enableForeignKeyConstraints();

            $new_project= new Project;
            $new_project->title = $faker->sentence(3);
            $new_project->description = $faker->text(2000);
            $new_project->slug= Str::slug($new_project->title,'-');;
            $new_project->client= $faker->name();
            $new_project->type_id= $type->id;
            $new_project->save();
        }   
    }
}
