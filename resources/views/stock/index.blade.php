@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Estoque</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        <a href="{{ route('stock.store') }}" class="btn btn-primary">Adicionar</a>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Marca</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Sabor</th>
                                <th scope="col">litragem</th>
                                <th scope="col">Valor Unitário</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stock_items as $item)
                            <tr>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->bottle_type }}</td>
                                <td>{{ $item->flavor }}</td>
                                <td>{{ $item->liters }}</td>
                                <td>{{ $item->unitary_value }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                    <i class="fa fa-edit" style="color: blue"></i>
                                    <i class="fa fa-remove" style="color: red"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $stock_items->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
