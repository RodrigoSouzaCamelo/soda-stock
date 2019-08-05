@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('brand.index') }}">Marcas</a> / Editar</div>

                <div class="card-body">
                    <form action="{{ route('brand.update', $brand->Id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Marca:</label>
                            <input type="text" name="name" class="form-control" 
                                                    placeholder="Nome da Marca" value="{{ $brand->Name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
