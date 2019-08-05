@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Marcas de Refrigerante</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        <a href="{{ route('brand.store') }}" class="btn btn-primary">Adicionar</a>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <i class="fa fa-edit" style="color: blue"></i>
                                    <i class="fa fa-remove" style="color: red"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $sodaItems->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
