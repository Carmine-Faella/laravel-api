@extends('layouts.admin')

@section('content')

<h1 class="text-white">Dettagli</h1>

    <div class="card my-5">
        <div class="row g-0">
          <div class="col-3">
            @if ($project->cover_image)
              <img clas="img-show" src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->title}}"/>
            @endif
          </div>
          <div class="col">
            <div class="card-body">
              <h5 class="card-title">{{$project->title}}</h5>
              <p class="card-text">{{$project->content}}</p>
              <p class="card-text"><span class="badge rounded-pill text-bg-info text-white">{{$project->type?$project->type->name:'Null'}}</span></p>
              @foreach ($project->tecnologies as $tecnology)
                <span class="badge rounded-pill text-bg-primary">{{$tecnology->name_tech}}</span>
              @endforeach
              <p class="card-text"><small class="text-body-secondary"><span class="badge rounded-pill text-bg-secondary">{{$project->slug}}</small></span></p>
              <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
            </div>
          </div>
        </div>
      </div>

@endsection