@extends('app')

@section('content')
<div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            @error('name')
            <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la categoría</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color de la categoría</label>
                <input type="color" name="color" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Crear nueva categoría</button>
        </form>
    </div>
    <div>
        @foreach ($categories as $cat)
        <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
                <a class="d-flex align-items-center gap-2"
                    href="{{ route('categories.edit', ['category' => $cat->id]) }}">
                    <span class="color-container" style="background-color: {{ $cat->color }}"></span>
                    {{ $cat->name }}
                </a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal{{ $cat->id }}">Eliminar</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal{{ $cat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar categoría?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Eliminar la categoría <strong>{{ $cat->name }}</strong> también eliminará las tareas con dicha categoría
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
