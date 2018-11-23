@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-3 my-2">
                <div class="card shadow">
                    <img src="{{ asset('img/posters/'.$movie->imgUrl) }}" class="rounded-top" width="100%"/>

                    <div class="card-footer shadow-sm">
                        <div>
                            <span class="small">Title:</span>

                            <span class="font-weight-bold float-right">{{ $movie->title }}</span>
                        </div>

                        <div>
                            <span class="small">Year:</span>

                            <span class="font-weight-bold float-right">{{ $movie->year }}</span>
                        </div>

                        <div>
                            <span class="small">Genres:</span>

                            <span class="font-weight-bold float-right">
                                @forelse($movie->genres()->pluck("name") as $genre)
                                    <span class="badge badge-info text-white py-1">
                                        {{ $genre }}
                                    </span>
                                @empty
                                    No genres found!
                                @endforelse
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col my-2">
                <div class="card shadow">
                    <video width="100%" class="rounded-top" controls>
                        <source src="{{ asset('video/1.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                    <div class="card-footer text-justify">
                        {{ $movie->about }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
