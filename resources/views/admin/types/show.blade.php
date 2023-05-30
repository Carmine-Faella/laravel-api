@extends('layouts.admin')

@section('content')

<h1 class="text-white">Dettagli</h1>

    <div class="card my-5">
        <div class="row g-0">
          <div class="col">
            <div class="card-body">
              <h5 class="card-title">{{$type->name}}</h5>
              <p class="card-text">{{$type->slug}}</p>
              <a href="{{route('admin.types.index')}}" class="btn btn-secondary">Torna alla lista</a>
            </div>
          </div>
        </div>
      </div>

@endsection