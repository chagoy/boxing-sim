@extends ('layouts.app')

@section ('content')
    <div class="container">
            <h1 class="title">History</h1>
            @if (count($game->cards) < 1)
            	<h3>You have not put on any cards yet!</h3>
            @elseif (count($game->cards) > 0)
	            <table class="table is-narrow is-striped">
	                <thead>
	                <tr>
	                    <th>Date</th>
	                    <th>Network</th>
	                    <th>Headline</th>
	                    <th>Result</th>
	                    <th>Attendance</th>
	                    <th>Revenue</th>
	                    <th>Viewers</th>
	                </tr>
	                </thead>
	                <tbody>
	                @foreach ($game->cards as $card)
	                    <tr>
	                        <td>{{ $card->date }}</td>
	                        <td>{{ $card->network }}</td>
	                        <td>{{ $card->headline }}</td>
	                        @foreach ($card->fights as $fight)
	                            @if ($fight->results === null)
	                                <td>N/A</td>
	                                <td>N/A</td>
	                                <td>N/A</td>
	                                <td>N/A</td>
	                            @else
	                                <td>{{ $fight->results->method }}</td>
	                                <td>{{ number_format($fight->revenue->attendance) }}</td>
	                                <td>${{ number_format($fight->revenue->revenue) }}</td>
	                                <td>{{ number_format($fight->revenue->viewers) }}</td>
	                            @endif
	                        @endforeach
	                    </tr>
	                @endforeach

	                </tbody>
	            </table>
	      	@endif
        </div>
@endsection