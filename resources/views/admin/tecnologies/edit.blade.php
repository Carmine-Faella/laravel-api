@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3">Crea un nuovo Project</h1>

    <div class="py-5 text-center">
        <a href="{{route('admin.tecnologies.index')}}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    <form method="POST" action="{{route('admin.tecnologies.update',['tecnology'=> $tecnology->slug])}}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_tech" class="form-label">Nome:</label>
            <input type="text" class="form-control @error('name_tech') is-invalid @enderror" id="name_tech" name="name_tech" value="{{ old('name_tech', $tecnology->name_tech) }}">
            @error('name_tech')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $tecnology->slug) }}">
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="py-3">
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>

@endsection