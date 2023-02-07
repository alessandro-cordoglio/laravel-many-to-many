@extends('layouts.admin')

@section('content')
    <h1>Linguaggi</h1>    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Slug</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($technologies as $technology)
            <tr>
                <td>{{$technology->name}}</td>
                <td>{{$technology->slug}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.technologies.show', $technology->slug)}}" class="btn btn-primary">Espandi</a>
                  <a href="{{route('admin.technologies.edit', $technology->slug)}}" class="mx-2 btn btn-success">Modifica</a>
                  <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Elimina</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <a href="{{route('admin.technologies.create')}}" class="btn btn-secondary">Crea nuova tipologia</a>
      </table>
@endsection