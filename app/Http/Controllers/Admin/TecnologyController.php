<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tecnology;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTecnologyRequest;
use App\Http\Requests\UpdateTecnologyRequest;
use Illuminate\Support\Facades\Validator;

class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.index', compact('tecnologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.create', compact('tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTecnologyRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Tecnology::generateSlug($request->name_tech);
        
        $checkPost = Tecnology::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo project, cambia il titolo']);
        };

        $newTech = Tecnology::create($form_data);

        return redirect()->route('admin.tecnologies.show', ['tecnology' => $newTech->slug])->with('status', 'Project aggiunto con successo');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function show(Tecnology $tecnology)
    {
        return view('admin.tecnologies.show', compact('tecnology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function edit(Tecnology $tecnology)
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.edit', compact('tecnology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTecnologyRequest $request, Tecnology $tecnology)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Tecnology::generateSlug($request->name_tech);

        $checkPost = Tecnology::where('slug', $form_data['slug'])->where('id','<>',$tecnology->id)->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo project, cambia il titolo']);
        }
        
        $tecnology->update($form_data);

        return redirect()->route('admin.tecnologies.show', ['tecnology' => $tecnology->slug])->with('status', 'Project Aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();

        return redirect()->route('admin.tecnologies.index', ['tecnology' => $tecnology->slug]);
    }
}
