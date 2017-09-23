@extends ('layouts.app')

@section ('content')
	<div class="container">
		<h3>Free Agents</h3>
	</div>
	
    <free-agents :boxers="{{ $boxers }}"></free-agents>
@endsection