<?php

namespace Database\Seeders;

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
            ['name' => 'Adobe Creative Cloud', 'logo_path' => 'adobe_creative-cloud.svg'],
            ['name' => 'Adobe Illustrator', 'logo_path' => 'adobe_illustrator.svg'],
            ['name' => 'Adobe InDesign', 'logo_path' => 'adobe_indesign.svg'],
            ['name' => 'Affinity', 'logo_path' => 'affinity.svg'],
            ['name' => 'ArcGIS', 'logo_path' => 'arcgis.png'],
            ['name' => 'Asana', 'logo_path' => 'asana.svg'],
            ['name' => 'A-Frame', 'logo_path' => 'a_frame.png'],
            ['name' => 'C++', 'logo_path' => 'c++.svg'],
            ['name' => 'GitHub Copilot', 'logo_path' => 'github_copilot.png'],
            ['name' => 'CSS', 'logo_path' => 'css_3.svg'],
            ['name' => 'Discord', 'logo_path' => 'discord.svg'],
            ['name' => 'Docker', 'logo_path' => 'docker.svg'],
            ['name' => 'Doxygen', 'logo_path' => 'doxygen.png'],
            ['name' => 'Facebook', 'logo_path' => 'facebook.svg'],
            ['name' => 'Figma', 'logo_path' => 'figma.svg'],
            ['name' => 'Git', 'logo_path' => 'git.svg'],
            ['name' => 'GitHub', 'logo_path' => 'github.svg'],
            ['name' => 'Google Ads', 'logo_path' => 'google_ads.svg'],
            ['name' => 'Google Drive', 'logo_path' => 'google_drive.svg'],
            ['name' => 'HTML', 'logo_path' => 'html_5.svg'],
            ['name' => 'Inkscape', 'logo_path' => 'inkscape.png'],
            ['name' => 'Instagram', 'logo_path' => 'instagram.svg'],
            ['name' => 'Java', 'logo_path' => 'java.svg'],
            ['name' => 'JavaScript', 'logo_path' => 'js.svg'],
            ['name' => 'LinkedIn', 'logo_path' => 'linkedin.svg'],
            ['name' => 'Mailchimp', 'logo_path' => 'mailchimp.svg'],
            ['name' => 'Meta', 'logo_path' => 'meta.svg'],
            ['name' => 'Miro', 'logo_path' => 'miro.svg'],
            ['name' => 'Microsoft Excel', 'logo_path' => 'ms_excel.svg'],
            ['name' => 'OneDrive', 'logo_path' => 'ms_onedrive.svg'],
            ['name' => 'PowerPoint', 'logo_path' => 'ms_powerpoint.svg'],
            ['name' => 'SharePoint', 'logo_path' => 'ms_sharepoint.svg'],
            ['name' => 'Word', 'logo_path' => 'ms_word.svg'],
            ['name' => 'Notion', 'logo_path' => 'notion.svg'],
            ['name' => 'PHP', 'logo_path' => 'php.svg'],
            ['name' => 'Pinterest', 'logo_path' => 'pinterest.svg'],
            ['name' => 'QGIS', 'logo_path' => 'qgis.png'],
            ['name' => 'Unity', 'logo_path' => 'unity_6.png'],
            ['name' => 'Visual Studio Code', 'logo_path' => 'vs_code.svg'],
            ['name' => 'Vuforia', 'logo_path' => 'vuforia.png'],
            ['name' => 'WordPress', 'logo_path' => 'wordpress.svg'],
            ['name' => 'Zotero', 'logo_path' => 'zotero.png'],
        ];

        foreach ($techs as $tech) {
            Tech::updateOrCreate(
                ['name' => $tech['name']],
                $tech,
            );
        }
    }
}
