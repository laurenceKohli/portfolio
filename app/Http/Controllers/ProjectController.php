<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Exp;
use App\Models\Tag;
use App\Models\Tech;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'projects' => Project::with('techs', 'tag')->get(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Project/ProjectCreate', [
            'tags' => Tag::all(),
            'techs' => Tech::orderBy('name')->get(['id', 'name', 'logo_path']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag_id' => ['required', 'integer', Rule::exists('table_tags', 'id')],
            'title' => ['required', 'string', 'max:255', Rule::unique('table_projects', 'title')],
            'date' => ['required', 'date'],
            'duration' => ['nullable', 'string'],
            'url' => ['nullable', 'url', 'max:255'],
            'goals' => ['required', 'string'],
            'desc' => ['required', 'string'],
            'team' => ['nullable', 'string'],
            'contribution' => ['required', 'string'],
            'proud' => ['nullable', 'string'],
            'on_home_page' => ['required', 'boolean'],
            'tech_ids' => ['nullable', 'array'],
            'tech_ids.*' => ['integer', Rule::exists('table_techs', 'id')],
            'new_techs' => ['nullable', 'array'],
            'new_techs.*.name' => ['required', 'string', 'max:255', 'distinct', Rule::unique('table_techs', 'name')],
            'new_techs.*.logo_file' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'exps' => ['nullable', 'array'],
            'exps.*.name' => ['required', 'string', 'max:255', 'distinct'],
            'imgs' => ['nullable', 'array'],
            'imgs.*.file' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
            'imgs.*.desc' => ['nullable', 'string'],
        ]);

        $project = DB::transaction(function () use ($validated) {
            $project = Project::create(collect($validated)->except(['tech_ids', 'new_techs', 'exps', 'imgs'])->all());

            $techIds = collect($validated['tech_ids'] ?? []);

            foreach ($validated['new_techs'] ?? [] as $tech) {
                $logoName = Str::uuid().'.'.$tech['logo_file']->extension();
                $tech['logo_file']->move(public_path('img/competences'), $logoName);
                $techIds->push(Tech::create([
                    'name' => $tech['name'],
                    'logo_path' => $logoName,
                ])->id);
            }

            $project->techs()->sync($techIds->unique()->values());

            $expIds = collect($validated['exps'] ?? [])->map(function (array $exp) {
                return Exp::firstOrCreate(['name' => $exp['name']])->id;
            });
            $project->exps()->sync($expIds);

            foreach ($validated['imgs'] ?? [] as $image) {
                $imageName = Str::uuid().'.'.$image['file']->extension();
                $image['file']->move(public_path('img/projects'), $imageName);
                $project->imgs()->create([
                    'img_path' => $imageName,
                    'desc' => $image['desc'] ?? null,
                ]);
            }

            return $project;
        });

        return redirect()->route('projects.show', $project)->with('success', 'Projet créé.');
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
        return Inertia::render('Project/ProjectEdit', [
            'project' => $this->getProject($id),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'tag_id' => ['required', 'integer', Rule::exists('table_tags', 'id')],
            'title' => ['required', 'string', 'max:255', Rule::unique('table_projects', 'title')->ignore($project->id)],
            'date' => ['required', 'date'],
            'duration' => ['nullable', 'string'],
            'url' => ['nullable', 'url', 'max:255'],
            'goals' => ['required', 'string'],
            'desc' => ['required', 'string'],
            'team' => ['nullable', 'string'],
            'contribution' => ['required', 'string'],
            'proud' => ['nullable', 'string'],
            'on_home_page' => ['required', 'boolean'],
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Projet modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::with('imgs')->findOrFail($id);
        $imagePaths = $project->imgs->pluck('img_path');

        DB::transaction(function () use ($project) {
            $project->techs()->detach();
            $project->exps()->detach();
            $project->imgs()->delete();
            $project->delete();
        });

        foreach ($imagePaths as $imagePath) {
            File::delete(public_path('img/projects/'.basename($imagePath)));
        }

        return redirect()->route('dashboard')->with('success', 'Projet supprimé.');
    }
}
