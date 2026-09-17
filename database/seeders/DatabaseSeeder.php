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
            'goals' => '<li>Tester les relations</li>',
            'desc' => 'Projet bidon',
            'contribution' => 'Backend',
            'on_home_page' => true
        ]);

        $project->techs()->createMany([
            ['name' => 'Laravel', 'logo_path' => 'laravel.png'],
            ['name' => 'Vue.js', 'logo_path' => 'vue.png'],
        ]);

        $project->imgs()->create([
            'img_path' => 'test.png',
        ]);

         $project2 = Project::create([
            'tag_id' => 2,
            'title' => 'Une histoire d\'Harry Potter',
            'date' => '2025-01-15',
            'duration' => 'automne 2024',
            'url' => 'https://harrypotter-visualdon24.netlify.app/',
            'goals' => '<li>Réaliser un contenu dans une logique de storytelling</li>',
            'desc' => '<p>Le but de ce projet est de répartir les participants dans les différentes maisons de Poudlard en fonction de leurs réponses à un questionnaire. </p><p>Le site leur fournit ensuite des explications détaillées sure leur maison tel que les personnages avec le plus de temps d\'écran, les personnages les plus connus et des informations sur comment la maison a été choisie.</p>',
            'team' => 'Nous étions en groupe par deux. Je faisais équipe avec Steve Pasche.',
            'contribution' => '<p>J\'ai réalisé la majorité des animations GSAP et Scrollama (Choixpeau, vif d\'or, affichage des personnes principales et des films, apparition de Dobby).</p><p>J\'ai également participé à l\'implémentation des différentes pages et à la lecture des données provenant de nos différentes sources.</p><p>Je me suis chargé du graphique en bâtons des maisons et celui des temps d\'écrans. Steve a implémenté la carte de description du personnage.</p>',
            'proud' => 'Je suis extrêmement fière des animations. J\'ai pu apprendre à utiliser GSAP et le vif d\'or réagissant au scroll autant en descendant qu\'en montant la page est ma plus grande réussite du projet.',
            'on_home_page' => true
        ]);

        $project2->techs()->createMany([
            ['name' => 'GSAP', 'logo_path' => 'gsap.png'],
            ['name' => 'D3.js', 'logo_path' => 'd3.png'],
            ['name' => 'Scrollama', 'logo_path' => 'scrollama.png'],
        ]);

        $project2->exp()->createMany([
            ['name' => 'Scrollytelling'],
            ['name' => 'Scrollama et GSAP'],
            ['name' => 'D3 : selection, array, axis, scale, transition'],
            ['name' => 'HTML, CSS, JS : : utilisation de variables, pas de framework'],
            ['name' => 'git : utilisation de branches, pull request, merge'],
            ['name' => 'GitHub : gestion des issues et des projets'],
            ['name' => 'Travail en équipe'],
        ]);

        $project2->imgs()->create([
            ['img_path' => 'HP-bento.png'],
            ['img_path' => 'HP-vifOr.png'],
            ['img_path' => 'HP-dataVis.png'],
        ]);

        
    }

}
