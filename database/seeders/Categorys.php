<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class Categorys extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'UI/UX & conception produit',
            ],
            [
                'name' => 'Design graphique & création visuelle',
            ],
            [
                'name' => 'Développement web & programmation',
            ],
            [
                'name' => 'Gestion de projet & production',
            ],
            [
                'name' => 'Communication & marketing',
            ],
            [
                'name' => 'Bureautique, recherche & productivité',
            ],
            [
                'name' => 'Réalité augmentée & cartographie',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']], // clé unique logique
                $category
            );
        }
    }
}
