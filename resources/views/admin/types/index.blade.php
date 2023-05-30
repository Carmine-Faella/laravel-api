@extends('layouts.admin')

@section('content')
<a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea una nuova card</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Slug</th>
        <th scope="col">Projects</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->name }}</td>
            <td>{{ $type->slug }}</td>
            <td>{{ count($type->projects) }}</td>
            <td  class="d-flex">
              <div>
                <a class="btn btn-primary" href="{{route('admin.types.show', $type->slug)}}">VEDI</a>
              </div>
              <div class="px-2">
                <a href="{{route('admin.types.edit', ['type' => $type->slug])}}" class="btn btn-info text-white">Modifica</a>
              </div>
              <form action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}" method="POST" onsubmit="return confirm('Vuoi Eliminare?');">
                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>

@endsection