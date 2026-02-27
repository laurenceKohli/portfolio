<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Project;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            Tags::class,
        ]);

        $tag = Tag::where('name', 'default')->first();

        $project = Project::create([
            'tag_id' => $tag->id,
            'title' => 'Test Project',
            'date' => now(),
            'goals' => 'Tester les relations',
            'desc' => 'Projet bidon',
            'contribution' => 'Backend'
        ]);

        $project->techs()->createMany([
            ['name' => 'Laravel', 'logo_path' => 'laravel.png'],
            ['name' => 'Vue.js', 'logo_path' => 'vue.png'],
        ]);

        $project->imgs()->create([
            'img_path' => 'test.png',
        ]);

        
    }

}
