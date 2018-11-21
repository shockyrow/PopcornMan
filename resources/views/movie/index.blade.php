@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 my-2">
                    <div class="card shadow">
                        <div class="card-body p-0 border-0">
                            <img src="{{ asset('img/posters/'.$movie->imgUrl) }}" class="rounded-top" width="100%"/>
                        </div>
                        <div class="card-footer">
                            {{ $movie->title }}
                            <span class="badge badge-dark float-right p-1">{{ $movie->year }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p>No movies found!</p>
            @endforelse
        </div>
    </div>
@endsection
