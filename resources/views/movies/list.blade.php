@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.general.search', ['list' => isset($list) ? $list : \App\Movie::all()->pluck('title')])
        @include('components.movie.list', ['movies' => isset($movies) ? $movies : \App\Movie::peginate(env('PEGINATION_SIZE', 4))])
    </div>
@endsection
