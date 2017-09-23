@extends ('layouts.app')

@section ('content')
	<div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="title">Pound-for-Pound</h1>
                <h3 class="subtitle">Presented by Corona</h3>
                <ol>
                    @foreach ($p4p as $boxer)
                        <li><strong>{{ $boxer->name }}</strong> {{ $boxer->win }}({{ $boxer->knockouts }})-{{ $boxer->loss }}-{{ $boxer->draws }}</li>
                    @endforeach
                </ol>
            </div>

            <div class="column">
                <h1 class="title">Biggest Draws</h1>
                <h3 class="subtitle">Presented by Hublot</h3>
                <ol>
                    @foreach ($popular as $boxer)
                        <li><strong>{{ $boxer->name }}</strong> - {{ $boxer->cost }}</li>
                    @endforeach
                </ol>
            </div>

            <div class="column">
                <h1 class="title">Biggest Punchers</h1>
                <h3 class="subtitle">Presented by Paulie Malignaggi</h3>
                <ol>
                    @foreach ($punchers as $boxer)
                        <li><strong>{{ $boxer->name }}</strong> - {{ $boxer->kopct }}%</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection