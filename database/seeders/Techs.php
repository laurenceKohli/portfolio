<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tech;
use Illuminate\Database\Seeder;

class Techs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techs = [
            ['name' => 'Adobe Creative Cloud', 'logo_path' => 'adobe_creative-cloud.svg', 'category' => 'Design graphique & création visuelle'],
            ['name' => 'Adobe Illustrator', 'logo_path' => 'adobe_illustrator.svg', 'category' => 'Design graphique & création visuelle'],
            ['name' => 'Adobe InDesign', 'logo_path' => 'adobe_indesign.svg', 'category' => 'Design graphique & création visuelle'],
            ['name' => 'Affinity', 'logo_path' => 'affinity.svg', 'category' => 'Design graphique & création visuelle'],
            ['name' => 'ArcGIS', 'logo_path' => 'arcgis.png', 'category' => 'Réalité augmentée & cartographie'],
            ['name' => 'Asana', 'logo_path' => 'asana.svg', 'category' => 'Gestion de projet & production'],
            ['name' => 'A-Frame', 'logo_path' => 'a_frame.png', 'category' => 'Développement web & programmation'],
            ['name' => 'C++', 'logo_path' => 'c++.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'GitHub Copilot', 'logo_path' => 'github_copilot.png', 'category' => 'Développement web & programmation'],
            ['name' => 'CSS', 'logo_path' => 'css_3.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Discord', 'logo_path' => 'discord.svg', 'category' => 'Gestion de projet & production'],
            ['name' => 'Docker', 'logo_path' => 'docker.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Doxygen', 'logo_path' => 'doxygen.png', 'category' => 'Gestion de projet & production'],
            ['name' => 'Facebook', 'logo_path' => 'facebook.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Figma', 'logo_path' => 'figma.svg', 'category' => 'UI/UX & conception produit'],
            ['name' => 'Git', 'logo_path' => 'git.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'GitHub', 'logo_path' => 'github.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Google Ads', 'logo_path' => 'google_ads.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Google Drive', 'logo_path' => 'google_drive.svg', 'category' => 'Gestion de projet & production'],
            ['name' => 'HTML', 'logo_path' => 'html_5.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Inkscape', 'logo_path' => 'inkscape.png', 'category' => 'Design graphique & création visuelle'],
            ['name' => 'Instagram', 'logo_path' => 'instagram.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Java', 'logo_path' => 'java.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'JavaScript', 'logo_path' => 'js.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'LinkedIn', 'logo_path' => 'linkedin.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Mailchimp', 'logo_path' => 'mailchimp.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Meta', 'logo_path' => 'meta.svg', 'category' => 'Communication & marketing'],
            ['name' => 'Miro', 'logo_path' => 'miro.svg', 'category' => 'UI/UX & conception produit'],
            ['name' => 'Microsoft Excel', 'logo_path' => 'ms_excel.svg', 'category' => 'Bureautique, recherche & productivité'],
            ['name' => 'OneDrive', 'logo_path' => 'ms_onedrive.svg', 'category' => 'Gestion de projet & production'],
            ['name' => 'PowerPoint', 'logo_path' => 'ms_powerpoint.svg', 'category' => 'Bureautique, recherche & productivité'],
            ['name' => 'SharePoint', 'logo_path' => 'ms_sharepoint.svg', 'category' => 'Gestion de projet & production'],
            ['name' => 'Word', 'logo_path' => 'ms_word.svg', 'category' => 'Bureautique, recherche & productivité'],
            ['name' => 'Notion', 'logo_path' => 'notion.svg', 'category' => 'UI/UX & conception produit'],
            ['name' => 'PHP', 'logo_path' => 'php.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Pinterest', 'logo_path' => 'pinterest.svg', 'category' => 'Communication & marketing'],
            ['name' => 'QGIS', 'logo_path' => 'qgis.png', 'category' => 'Réalité augmentée & cartographie'],
            ['name' => 'Unity', 'logo_path' => 'unity_6.png', 'category' => 'Réalité augmentée & cartographie'],
            ['name' => 'Visual Studio Code', 'logo_path' => 'vs_code.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Vuforia', 'logo_path' => 'vuforia.png', 'category' => 'Réalité augmentée & cartographie'],
            ['name' => 'WordPress', 'logo_path' => 'wordpress.svg', 'category' => 'Développement web & programmation'],
            ['name' => 'Zotero', 'logo_path' => 'zotero.png', 'category' => 'Bureautique, recherche & productivité'],
        ];

        $categoryIds = Category::pluck('id', 'name');
        $homePageTechs = [
            'Adobe Creative Cloud',
            'Figma',
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'WordPress',
            'Git',
            'Asana',
        ];

        foreach ($techs as $tech) {
            $categoryId = $categoryIds[$tech['category']];
            unset($tech['category']);

            Tech::updateOrCreate(
                ['name' => $tech['name']],
                [
                    ...$tech,
                    'category_id' => $categoryId,
                    'on_home_page' => in_array($tech['name'], $homePageTechs, true),
                ],
            );
        }
    }
}
