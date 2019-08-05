@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('stock.index') }}">Estoque</a> / Adicionar</div>

                <div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Marca</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Sabor</th>
                                <th scope="col">litragem</th>
                                <th scope="col">Valor Unitário</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sodas as $item)
                            <tr>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->bottle_type }}</td>
                                <td>{{ $item->flavor }}</td>
                                <td>{{ $item->liters }}</td>
                                <td>{{ $item->unitary_value }}</td>
                                <td>
                                    <a href="{{ route('stock.add', $item->id) }}"><i class="fa fa-plus-circle" style="color: blue"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $sodas->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
