@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3">Crea una nuova Card</h1>

    <div class="py-5 text-center">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    <form method="POST" action="{{route('admin.projects.store')}}" enctype=“multipart/form-data”>

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Descrizione (max 1000)(opzionale):</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Seleziona l'immagine da inserire:</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
            @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option  @selected(old('type_id')=='') value="">Nessun type</option>
                @foreach ($types as $type)
                    <option @selected(old($type->type_id)==$type->id) value="{{$type->id}}">{{$type->name}}</option>
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
                <input id="tecnology_{{$tecnology->id}}" @if (in_array($tecnology->id , old('tecnologies', []))) checked @endif type="checkbox" name="tecnologies[]" value="{{$tecnology->id}}">
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

@endsection