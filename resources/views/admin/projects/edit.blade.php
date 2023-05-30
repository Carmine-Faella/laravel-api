@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3">Crea un nuovo Project</h1>

    <div class="py-5 text-center">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    <form method="POST" action="{{route('admin.projects.update',['project'=> $project->slug])}}" enctype=“multipart/form-data”>

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Descrizione (max 1000)(opzionale):</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $project->content) }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Seleziona l'immagine da inserire:</label>

            @if ($project->cover_image)
                <div class="img-wrap">
                    <img src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->title}}"/>
                    <div id="btn-delete" class="btn btn-danger img-wrap-del">X</div>
                </div>
            @endif

            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
            @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option @selected(old('category_id', $project->type_id)=='') value="">Nessun type</option>
                @foreach ($types as $type)
                    <option @selected(old('type_id', $type->type_id)==$type->id) value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            @foreach($tecnologies as $tecnology)
                @if ($errors->any())
                    <input id="tcnology_{{$tecnology->id}}" @if (in_array($tecnology->id , old('tecnologies', []))) checked @endif type="checkbox" name="tecnologies[]" value="{{$tecnology->id}}">
                @else
                    <input id="tcnology_{{$tecnology->id}}" @if ($project->tecnologies->contains($tecnology->id)) checked @endif type="checkbox" name="tecnologies[]" value="{{$tecnology->id}}">
                @endif                
                <label for="tecnology_{{$tecnology->id}}"  class="form-label">{{$tecnology->name_tech}}</label>
                <br>
            @endforeach
            @error('tecnologies')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="py-3">
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>

    <form id="form-delete" action="{{route('admin.projects.deleteImage', ['slug' => $project->slug])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>

@endsection