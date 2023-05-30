@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3">Crea una nuova Card</h1>

    <div class="py-5 text-center">
        <a href="{{route('admin.types.index')}}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    <form method="POST" action="{{route('admin.types.store')}}">

        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="py-3">
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>

@endsection