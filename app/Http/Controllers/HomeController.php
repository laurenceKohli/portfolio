<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tech;

use Illuminate\Http\Request;
use Inertia\Inertia;


class HomeController extends Controller
{
    /**
     * Display the home page
     * 
     * @return \Inertia\Response
     */    
    public function home()
    {
        $allProjects = Project::all()->where('on_home_page', '=', true);

        foreach ($allProjects as $project) {
            $project->imgs = $project->imgs()->take(1)->get();
        }

        $allProjects = $allProjects->select('id', 'title', 'desc', 'imgs', 'techs', 'url');

        $allTechs = Tech::all()->select('id', 'logo_path', 'name');

        return Inertia::render('Home', [
            'projects' => $allProjects,
            'skills' => $allTechs
        ]);
    }
}
