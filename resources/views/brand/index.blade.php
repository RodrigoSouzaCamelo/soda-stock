@extends('layouts.app')

@section('scripts')
<script>
    function btnDeleteBrand(id)
    {
        var deleteBrand = confirm("Você realmente deseja deleter essa marca?");

        var url = "{{ route('brand.delete', ':id') }}";
        url = url.replace(':id', id);

        if(deleteBrand)
             window.location.href = url;
    }
</script>
@endsection

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
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $item)
                            <tr>
                                <td>{{ $item->Name }}</td>
                                <td>
                                    <a href="{{ route('brand.edit', $item->Id) }}"><i class="fa fa-edit" style="color: blue"></i></a>
                                    <a onclick="btnDeleteBrand({{ $item->Id }});" style="cursor:pointer;">
                                        <i class="fa fa-remove" style="color: red"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $brands->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
