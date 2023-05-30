<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Tecnology;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreTecnologyRequest;
use App\Http\Requests\UpdateTecnologyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('types','tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($request->title);
        
        $checkPost = Project::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo Project, cambia il titolo']);
        };

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cover', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $newProject = Project::create($form_data);

        if ($request->has('tecnologies')) {
            $newProject->tecnologies()->attach($request->tecnologies);
        }

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('status', 'Project aggiunto con successo');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project','types','tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($request->title);

        $checkPost = Project::where('slug', $form_data['slug'])->where('id','<>',$project->id)->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo project, cambia il titolo']);
        }

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::put('cover', $request->cover_image);
            $form_data['cover_image'] = $path;

        }

        $project->tecnologies()->sync($request->tecnologies);
        $project->update($form_data);

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('status', 'Project Aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->cover_image){
            Storage::delete($project->cover_image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index', ['project' => $project->slug]);
    }

    public function deleteImage($slug) {

        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
            $project->cover_image = null;
            $project->save();
        }

        return redirect()->route('admin.projects.edit', $project->slug);

    }

}
