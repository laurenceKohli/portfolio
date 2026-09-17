<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Inertia\Response
     */
    public function index()
    {
         $allProjects = Project::all()->load('techs', 'tag', 'imgs' );
         $allTags = Tag::all();

        return Inertia::render('Project/ProjectIndex', ['projects' => $allProjects, 'tags' => $allTags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Inertia\Response
     */
    public function show(string $id)
    {
       return Inertia::render('Project/ProjectShow', ['project' => $this->getProject($id)]);
    }

    public function getProject(string $id)
    {
        $project = Project::findOrFail($id)->load('tag', 'techs', 'imgs', 'exps');

        return $project;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
