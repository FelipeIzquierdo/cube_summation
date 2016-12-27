@extends('app.layout')
@section('content_header')
    <h1 class="text-center">Cube Summation</h1>
    <div class="row">
        <div class="col-md-12">
            @if(empty ($test_case))
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cube</h3>
                </div>
                {!! Form::open(['route' => 'test_cases.create', 'method' => 'post']) !!}
                    <div class="box-body">
                        {!!  Field::text('tests_number',['ph' => 'Numero casos de pruebas']) !!}
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                {!! Form::close() !!}
            </div>

            @else
                @if(!$test_case->cubes->all())
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cube</h3>
                        </div>
                        {!! Form::open(['route' => ['cube.create',$test_case], 'method' => 'post']) !!}
                        {!! method_field('POST') !!}
                        <div class="box-body">
                        @foreach(range(1,$test_case->tests_number) as $i)
                            <h3>Test Case  N°{!! $i !!}</h3>
                            <div class="col-md-6">
                                {!!  Field::text('cube.'.$i.'.last_coordinate', ['name' => 'cube['.$i.'][last_coordinate]', 'id' =>'cube.'.$i.'.last_coordinate' ]) !!}
                            </div>
                            <div class="col-md-6">
                                {!!  Field::text('cube.'.$i.'.queries_number', ['name' => 'cube['.$i.'][queries_number]', 'id' =>'cube.'.$i.'.queries_number' ]) !!}
                            </div>
                        @endforeach
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @else
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cube Queries</h3>
                        </div>
                        {!! Form::open(['route' => ['cube.queries',$test_case], 'method' => 'post']) !!}
                        {!! method_field('POST') !!}
                        <div class="box-body">
                            <p>1. UPDATE x y z W <br>
                                2. QUERY  x1 y1 z1 x2 y2 z2 </p>
                            @foreach($test_case->cubes as $key => $cube)
                                <h3>Test Case  N°{!! 1+$key !!}</h3>
                                @foreach(range(1,$cube->queries_number) as $i)
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            {!!  Field::select('cube.'.$cube->id.'.'.$i.'.type', ['QUERY' => 'QUERY', 'UPDATE' => 'UPDATE'],['name' => 'cube['.$cube->id.']['.$i.'][type]', 'id' => 'cube.'.$cube->id.'.'.$i.'.type' , 'empty' => 'Select Type  Query']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!!  Field::text('cube.'.$cube->id.'.'.$i.'.values', ['name' => 'cube['.$cube->id.']['.$i.'][values]', 'id' => 'cube.'.$cube->id.'.'.$i.'.values' ]) !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection