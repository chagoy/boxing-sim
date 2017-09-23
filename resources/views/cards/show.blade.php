@extends ('layouts.app')

@section ('content')

	<div class="container">
		<h1>{{ $card->headline }}</h1>

		@foreach ($card->fights as $fight)
			 {{ $fight->boxers[0]->name }} {{ $fight->boxers[0]->win }}({{ $fight->boxers[0]->knockouts }})-{{ $fight->boxers[0]->loss }}-{{$fight->boxers[0]->draws }} vs {{ $fight->boxers[1]->name }} {{ $fight->boxers[1]->win }}({{ $fight->boxers[1]->knockouts }})-{{ $fight->boxers[1]->loss }}-{{$fight->boxers[1]->draws }}

                <a class="btn btn-xs" href="/fight/{{ $fight->id }}/{{ $fight->boxers[0]->id }}/{{ $fight->boxers[1]->id }}">Sim</a>

        @endforeach
	</div>

@endsection