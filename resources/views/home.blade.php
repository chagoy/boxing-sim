@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Fighters Currently Under Contract</h3>
                <ul class="list-group">
                    @foreach ($boxers as $boxer)
                        <li class="list-group-item justify-content-between">
                            <a href="/boxers/{{ $boxer->id}}">
                                {{ $boxer->name }}
                            </a>
                            <span class="badge badge-default badget-pill">
                            {{ $boxer->win }}-{{ $boxer->loss }}-{{ $boxer->draws}} ({{ $boxer->knockouts }} KOs)
                        </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>Revenue</h3>
                <revenue-chart :revenue="{{ $results }}"></revenue-chart>
            </div>
            <div class="col-md-4">
                <h3>Viewers</h3>
                <viewers-chart :viewers="{{ $viewers }}"></viewers-chart>          
            </div>
            <div class="col-md-4">
                <h3>Attendance</h3>
                <attendance-chart :attendance="{{ $attendance }}"></attendance-chart>
            </div>
        </div>
    </div>
    


@endsection
