@extends ('layouts.app')

@section ('content')
	<section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Sign A Fight</h1>
                <h3 class="subtitle">Make $</h3>
            </div>
        </div>
    </section>
    <div class="container">
        <create-card :boxers="{{ json_encode($boxers) }}" :networks="{{ json_encode($networks) }}" :userboxers="{{ json_encode($userBoxers) }}" :locations="{{ json_encode($location) }}"></create-card>
    </div>
@endsection