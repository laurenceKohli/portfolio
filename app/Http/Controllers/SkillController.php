<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        $categories = Category::with(['techsCategory' => function ($query) {
            $query->orderBy('name');
        }])
            ->orderBy('id')
            ->get();
        $skills = Tech::with(['category', 'projects:id,title'])
            ->orderBy('name')
            ->get();

        return Inertia::render('Skill/SkillIndex', [
            'categories' => $categories,
            'skills' => $skills,
        ]);
    }

    public function edit(Tech $tech)
    {
        return Inertia::render('Skill/SkillEdit', [
            'tech' => $tech->load(['category', 'projects:id,title']),
            'categories' => Category::orderBy('name')->get(),
            'projects' => Project::orderBy('title')->get(['id', 'title']),
        ]);
    }

    public function update(Request $request, Tech $tech)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('table_techs', 'name')->ignore($tech->id)],
            'category_id' => ['required', 'integer', Rule::exists('table_categorys', 'id')],
            'on_home_page' => ['required', 'boolean'],
            'logo_file' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'project_ids' => ['nullable', 'array'],
            'project_ids.*' => ['integer', Rule::exists('table_projects', 'id')],
        ]);

        if ($request->hasFile('logo_file')) {
            $logoName = Str::uuid().'.'.$request->file('logo_file')->extension();
            $request->file('logo_file')->move(public_path('img/competences'), $logoName);
            $validated['logo_path'] = $logoName;
        }

        unset($validated['logo_file']);
        $projectIds = $validated['project_ids'] ?? [];
        unset($validated['project_ids']);
        $previousLogo = $tech->logo_path;
        $tech->update($validated);
        $tech->projects()->sync($projectIds);

        if (isset($validated['logo_path']) && $previousLogo !== $validated['logo_path']) {
            File::delete(public_path('img/competences/'.basename($previousLogo)));
        }

        return redirect()->route('dashboard')->with('success', 'Compétence modifiée.');
    }
}