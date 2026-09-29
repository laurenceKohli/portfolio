<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class Tags extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'développement',
                'color' => '#e02626',
            ],
            [
                'name' => 'UX/design',
                'color' => '#0d1fc2',
            ],
            [
                'name'=> 'branding',
                'color'=> '#34bd84',
            ],
            [
                'name' => 'marketing',
                'color' => '#FF5722',
            ],
            [
                'name' => 'communication',
                'color' => '#24bbf7',
            ],
            [
                'name' => 'innovation',
                'color' => '#10e43e',
            ],
            [
                'name' => 'interdisciplinaire',
                'color' => '#aa24f7',
            ],
            [
                'name'=> 'recherche',
                'color'=> '#bf67d5',
            ],
            [
                'name'=> 'gestion de projet',
                'color'=> '#797575',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                ['name' => $tag['name']], // clé unique logique
                $tag
            );
        }
    }
}
