@extends('app.layout')
@section('content_header')
    <h1 class="text-center">Cube Summation</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cubes Results</h3>
                </div>

                <div class="box-body">
                    @foreach($test_case->cubes as $key => $cube)
                        <h3>Test Case  N°{!! 1+$key !!} value N = {!! $cube->last_coordinate !!}</h3>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <strong>Queries</strong> <br><br>
                                        <ul>
                                            @foreach($cube->cubeQueries as $query)
                                                @if($query->isQuery())
                                                    <li>{{ $query->type.' '.$query->x1.' '.$query->y1.' '.$query->z1.' '.$query->x2.' '.$query->y2.' '.$query->z2 }}</li>
                                                @else
                                                    <li>{{ $query->type.' '.$query->x1.' '.$query->y1.' '.$query->z1.' '.$query->w }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <strong> Results</strong> <br><br>
                                        <ul>
                                            @foreach($cube->cubeQueries as $query)
                                                <li>{{ $query->result }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <a href="/test_cases" class="btn btn-success">Restart</a>
                </div>

            </div>
        </div>
    </div>
@endsection
