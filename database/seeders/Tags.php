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
                'name' => 'certification',
                'color' => '#e02626',
            ],
            [
                'name' => 'projet de cours',
                'color' => '#0d1fc2',
            ],
            [
                'name' => 'projet professionnel',
                'color' => '#FF5722',
            ],
            [
                'name' => 'bénévolat',
                'color' => '#24bbf7',
            ],
            [
                'name' => 'camps',
                'color' => '#10e43e',
            ],
            [
                'name' => 'default',
                'color' => '#aa24f7',
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
