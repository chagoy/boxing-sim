@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1>{{ $boxer->name }}</h1>
        <h3>{{ $boxer->division }}, {{ $boxer->win }}({{ $boxer->knockouts }})-{{ $boxer->loss }}@if ($boxer->draws > 0)-{{ $boxer->draws }} @endif</h3>
        <div class="row">
            <div class="col-md-10">
                <stats-bar :funds="{{ auth()->user()->game->money }}" :boxer="{{ $boxer }}"></stats-bar>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
        		@if (Auth::user()->game->id === $boxer->game_id && $boxer->promoter_id === 1)
						<cut :game="{{ auth()->user()->game->id }}" :boxer="{{ $boxer }}"></cut>
					@elseif (Auth::user()->game->id === $boxer->game_id)
						<sign :funds={{ auth()->user()->game->money }} :game="{{ auth()->user()->game->id }}" :boxer="{{ $boxer }}"></sign>
					@endif
        	</div>
        </div>
    </div>
@endsection