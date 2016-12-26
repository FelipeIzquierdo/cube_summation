@extends('app.layout')
@section('content_header')
    <h1 class="text-center">Cube Summation</h1>
    <div class="row">
        <div class="col-md-12">
            @if(empty ($testcases))
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cube</h3>
                </div>
                {!! Form::open(['route' => 'cube.init_test_cases', 'method' => 'get']) !!}
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
                        <h3 class="box-title">Cube</h3>
                    </div>
                    {!! Form::open(['route' => 'cube.create', 'method' => 'post']) !!}
                    {!! method_field('POST') !!}
                    <div class="box-body">
                    @foreach(range(0,$testcases-1) as $i)
                        <h3>Test Case  N°{!! $i+1 !!}</h3>
                        <div class="col-md-6">
                            {!!  Field::text('operations', ['name' => 'cube['.$i.'][operations]', 'id' =>'cube.'.$i.'.operations' ]) !!}
                        </div>
                        <div class="col-md-6">
                            {!!  Field::text('last_coordinate', ['name' => 'cube['.$i.'][last_coordinate]', 'id' =>'cube.'.$i.'.last_coordinate' ]) !!}
                        </div>
                    @endforeach
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
@endsection