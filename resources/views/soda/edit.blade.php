@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('soda.index') }}">Refrigerantes</a> / Editar</div>

                <div class="card-body">
                    <form action="{{ route('soda.update', $soda->Id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::Label('brands', 'Marca:') !!}
                            {!! Form::select('brandid', $brands, $soda->brandId, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('bottleTypes', 'Tipo da Garrafa:') !!}
                            {!! Form::select('bottleTypeid', $bottleTypes, $soda->BottleTypeId, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="flavor">Sabor:</label>
                            <input type="text" name="flavor" class="form-control" placeholder="Sabor">
                        </div>
                        <div class="form-group">
                            <label for="liters">Litragem:</label>
                            <select name="liters" class="form-control">
                                <option value="0.250" {{ $soda->Liters == 0.250 ? "selected":"" }}>250 mL</option>
                                <option value="0.600" {{ $soda->Liters == 0.600 ? "selected":"" }}>600 mL</option>
                                <option value="1" {{ $soda->Liters == 1 ? "selected":"" }}>1 L</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unitaryValue">Valor Unitário:</label>
                            <input type="number" step="0.01" name="unitaryValue"
                                class="form-control" min="0.01" max="100"
                                value="{{ $soda->UnitaryValue }}" placeholder="0.00">
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
