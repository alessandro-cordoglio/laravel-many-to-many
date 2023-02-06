@extends('layouts.admin')

@section('content')
    <h1>Progetti</h1>    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Cliente</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->client}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.projects.show', $project->slug)}}" class="btn btn-primary">Espandi</a>
                  <a href="{{route('admin.projects.edit', $project->slug)}}" class="mx-2 btn btn-success">Modifica</a>
                  <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Elimina</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <a href="{{route('admin.projects.create')}}" class="btn btn-secondary">Crea nuovo progetto</a>
      </table>
@endsection