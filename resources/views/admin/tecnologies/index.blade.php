@extends('layouts.admin')

@section('content')
<a href="{{route('admin.tecnologies.create')}}" class="btn btn-primary">Crea una nuova tech</a>
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
        @foreach ($tecnologies as $tecnology)
          <tr>
            <td>{{ $tecnology->id }}</td>
            <td>{{ $tecnology->name_tech }}</td>
            <td>{{ $tecnology->slug }}</td>
            <td>{{ count($tecnology->projects) }}</td>
            <td  class="d-flex">
              <div>
                <a class="btn btn-primary" href="{{route('admin.tecnologies.show', $tecnology->slug)}}">VEDI</a>
              </div>
              <div class="px-2">
                <a href="{{route('admin.tecnologies.edit', ['tecnology' => $tecnology->slug])}}" class="btn btn-info text-white">Modifica</a>
              </div>
              <form action="{{ route('admin.tecnologies.destroy', ['tecnology' => $tecnology->slug]) }}" method="POST" onsubmit="return confirm('Vuoi Eliminare?');">
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