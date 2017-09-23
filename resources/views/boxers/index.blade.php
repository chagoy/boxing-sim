@extends ('layouts.app')

@section ('content')
	<user-boxers :boxers="{{ $myBoxers }}"></user-boxers>
@endsection