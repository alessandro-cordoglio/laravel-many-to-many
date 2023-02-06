@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Modifica "{{$project->title}}"</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="p-5" action="{{route('admin.projects.update', $project)}}" method="POST">
    @csrf
    @method('PUT')
        <label for="title" class="form-label">Titolo</label>
        <input type="text" id="title" class="form-control" name="title" style="width:20rem" value="{{old('title',$project->title)}}">

        <label for="client" class="form-label mt-4">Nome Cliente</label>
        <input type="text" id="client" class="form-control" name="client" style="width:20rem" value="{{old('client',$project->client)}}">

        <label for="cover_image" class="form-label mt-4">immagine</label>
        <input type="file" id="cover_image" class="form-control" name="cover_image" style="width:20rem" value="{{old('client',$project->cover_image)}}">

        <label for="description" class="form-label mt-4">Descrizione Progetto</label>
        <textarea class="form-control" name="description" id="description" style="width: 30rem; height:10rem">{{old('description', $project->description)}}</textarea>


        <label for="type" class="form-label">Tipologia</label>
        <select class="form-control" name="type_id" id="type" style="width:20rem">
            <option value="">Nessuna tipologia</option>
            @foreach ($types as $type)
                <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}} >{{$type->name}}</option>
            @endforeach
        </select>

        <button type="submit" class="my-5 btn btn-success">Modifica</button>
    </form>
@endsection