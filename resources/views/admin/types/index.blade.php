@extends('layouts.admin')

@section('content')
    <h1>Tipologie</h1>    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Slug</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->slug}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.types.show', $type->slug)}}" class="btn btn-primary">Espandi</a>
                  <a href="{{route('admin.types.edit', $type->slug)}}" class="mx-2 btn btn-success">Modifica</a>
                  <form action="{{route('admin.types.destroy', $type)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Elimina</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <a href="{{route('admin.types.create')}}" class="btn btn-secondary">Crea nuova tipologia</a>
      </table>
@endsection