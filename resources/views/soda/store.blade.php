@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('soda.index') }}">Refrigerantes</a> / Adicionar</div>

                <div class="card-body">
                    <form action="{{ route('soda.create') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::Label('brands', 'Marca:') !!}
                            {!! Form::select('brands', $brands, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('bottleTypes', 'Tipo da Garrafa:') !!}
                            {!! Form::select('bottleTypes', $bottleTypes, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="flavor">Sabor:</label>
                            <input type="text" name="flavor" class="form-control" placeholder="Sabor">
                        </div>
                        <div class="form-group">
                            <label for="liters">Litragem:</label>
                            <select name="liters" class="form-control">
                                <option value="0.250">250 mL</option>
                                <option value="0.600">600 mL</option>
                                <option value="1">1 L</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unitaryValue">Valor Unitário:</label>
                            <input type="number" step="0,01" name="unitaryValue" 
                                class="form-control" min="0,01" max="100" placeholder="0,00">
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
