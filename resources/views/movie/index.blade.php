@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 my-2">
                    <a href="{{ url('/movie/'.$movie->id) }}" class="btn p-0">
                        <div class="card shadow">
                            <img src="{{ asset('img/posters/'.$movie->imgUrl) }}" class="rounded-top" width="100%"/>

                            <div class="card-footer shadow-sm text-center">
                                <div class="small">{{ $movie->year }}</div>

                                <h5 class="m-0">{{ $movie->title }}</h5>

                                <div class="small">
                                    @forelse($movie->genres()->pluck("name") as $genre)
                                        {{ $genre }}
                                    @empty
                                        No genres found!
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>No movies found!</p>
            @endforelse
        </div>
    </div>
@endsection
