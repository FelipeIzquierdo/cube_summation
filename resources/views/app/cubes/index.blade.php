@extends('app.layout')
@section('content_header')
    <h1 class="text-center">Cube Summation</h1>
    <div class="row">
        <div class="col-md-12">
            @if(empty ($testcases))
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                {!! Form::open(['route' => 'cube.init_test_cases']) !!}
                    <div class="box-body">
                        {!!  Field::text('testcases',['ph' => 'Numero casos de pruebas']) !!}
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                {!! Form::close() !!}
            </div>

            @else
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <div class="box-body">
                    @for($i = 1; $i <= $testcases; $i++)
                        <h3>Caso de Prueba N°{!! $i !!}</h3>
                        {!!  Field::text('last_coordinate['.$i.']',['ph' => 'Ultima Coordenada']) !!}
                        {!!  Field::text('operations['.$i.']',['ph' => 'Numero de Operacione']) !!}
                        <hr>
                    @endfor
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection