@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{$project->title}}</h1>
        @if ($project->type?->name)
            <div class="d-flex align-items-center">
                <h3 class="me-2">Tipologia:</h3> 
                <a href="{{route('admin.types.show', $project->type->slug)}}">{{$project->type->name}}</a>
            </div>
        @else
            <h3 class="mb-3">Nessuna di tipologia</h3>
        @endif
        @if ($project->cover_image)
            <div>
                <img src="{{asset("storage/$project->cover_image")}}" alt="{{$project->title}}">
            </div>
        @endif
        <p>{{$project->description}}</p>
    </div>

@endsection